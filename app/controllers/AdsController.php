<?php

use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;
use Omnipay\Omnipay;

class AdsController extends \BaseController {


    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    protected  $user;

    public function __construct(UserRepository $user,SiteSettingsRepository $siteSettings)
    {
        parent::__construct($siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
    }

    public function adsPage()
    {
        $adSpaces = AdPricing::with('ad')->get();
        $user = User::where('id',Auth::user()->id)->where('deleted_at', NULL)->with('profilePicture', 'ads')->first();
        $this->layoutData['user'] = $user;
        $this->layoutData['adSpaces'] = $adSpaces;
        return View::make('ads',$this->layoutData);
    }

    public function buyAd()
    {
        $user = Auth::user();
        $image = Input::file('ad_image');
        $filename = str_random(32).".jpg";
        $image->move('uploads', $filename);

        $ad = new Ad;
        $ad->user_id = $user->id;
        $ad->ad_slot = Input::get('slot_id');
        $ad->clicks = 0;
        $ad->impressions = 0;
        $ad->paid = 0;
        $ad->content = json_encode(['link' => Input::get('ad_link'), 'img' => 'uploads/'.$filename]);
        $ad->filters = json_encode(['start_age' => Input::get('start_age'), 'end_age' => Input::get('end_age'), 'gender' => Input::get('gender'), 'place' => Input::get('place')]);
        $ad->save();

        Session::put('buying_ad_id', $ad);

        return Redirect::route('checkoutAd');
    }

    public function checkoutAd()
    {
        $ad = Session::get('buying_ad_id');
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(Config::get('paypal.username'));
        $gateway->setPassword(Config::get('paypal.password'));
        $gateway->setSignature(Config::get('paypal.signature'));
        $gateway->setTestMode(true);

        $response = $gateway->purchase(
            array(
                'cancelUrl'=>URL::route('purchaseFailed'),
                'returnUrl'=>URL::route('purchaseSuccess'),
                'amount' =>  (float)$ad->pricing()->first()->price,
                'currency' => 'USD',
                'Description' => 'Ad Slot Purchase'
            )

        )->send();

        $response->redirect();
    }

    public function purchaseFailed()
    {
        Session::forget('buying_ad_id');
        return Redirect::route('adsPage')->withError('Payment Failed. Try again later.');
    }

    public function purchaseSuccess()
    {
        $ad = Session::get('buying_ad_id');
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(Config::get('paypal.username'));
        $gateway->setPassword(Config::get('paypal.password'));
        $gateway->setSignature(Config::get('paypal.signature'));
        $gateway->setTestMode(true);

        $response = $gateway->purchase(
            array(
                'cancelUrl'=>URL::route('purchaseFailed'),
                'returnUrl'=>URL::route('purchaseSuccess'),
                'amount' =>  (float)$ad->pricing()->first()->price,
                'currency' => 'USD',
                'Description' => 'Ad Slot Purchase'
            )

        )->send();

        $data = $response->getData();

        Session::forget('buying_ad_id');

        if($data['ACK'] == 'Success')
        {
            $ad->paid = 1;
            $ad->save();

            return Redirect::route('adsPage')->withSuccess('Ad Purchased successfully');
        }
        else
        {
            return Redirect::route('adsPage')->withSuccess('Ad Purchase Failed');
        }
    }

    public function editAd()
    {
        $ad = Ad::find(Input::get('ad_id'));
        $content = json_decode($ad->content, true);
        $filters = json_decode($ad->filters, true);

        $content['link'] = Input::get('ad_link');
        $filters['start_age'] = Input::get('start_age');
        $filters['end_age'] = Input::get('end_age');
        $filters['gender'] = Input::get('gender');
        $filters['place'] = Input::get('place');

        if(Input::hasFile('ad_image')) {
            $image = Input::file('ad_image');
            $filename = str_random(32) . ".jpg";
            $image->move('uploads', $filename);
            $content['img'] = 'uploads/'.$filename;
        }

        $ad->content = json_encode($content);
        $ad->filters = json_encode($filters);
        $ad->save();

        return Redirect::back()->withSuccess('Ad updated successfully');
    }

    public function deleteAd($id)
    {
        $ad = Ad::find($id);
        $ad->delete();

        return Redirect::back()->withSuccess('Ad deleted successfully');
    }

    public function adClick($id)
    {
        $ad = Ad::find($id);
        $ad->clicks += 1;
        $ad->save();
        $link = json_decode($ad->content, true)['link'];

        return Redirect::to($link);
    }
}