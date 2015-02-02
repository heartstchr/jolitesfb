<?php

use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;

class HomeController extends \DashController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    function __construct(UserRepository $user,SiteSettingsRepository $siteSettings)
    {
        parent::__construct($user,$siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
    }

    public function showWelcome()
	{
        return View::make('login',$this->layoutData);
	}

    /**
     * After user email verification, welcome screen displayed
     *
     */
    public function welcome()
    {
        $this->layoutData['user'] = Auth::user();
        return View::make('welcome',$this->layoutData);
    }


    public function search(){
        $this->layoutData['user'] = User::where('id',Auth::user()->id)->where('deleted_at', NULL)->with('profilePicture', 'posts')->first();
        $query = Input::has('q')?Input::get('q'):'';

        $users = User::where('first_name','LIKE','%'.$query.'%')->orWhere('last_name','LIKE','%'.$query.'%')->with('profilePicture')->get();

        return View::make('search',$this->layoutData)->withUsers($users)->withQuery($query);
    }

}
