<?php

use Carbon\Carbon;
use Facebook\Repositories\Eloquent\AlbumRepository;
use Facebook\Repositories\Eloquent\MediaRepository;
use Facebook\Repositories\Eloquent\SiteSettingsRepository;
use Facebook\Repositories\Eloquent\UserRepository;

class ProfileController extends \DashController {

    /**
     * @var Facebook\Repositories\Eloquent\UserRepository
     */
    protected  $user;

    /**
     * @var Facebook\Repositories\Eloquent\AlbumRepository
     */
    protected  $album;

    /**
     * @var Facebook\Repositories\Eloquent\MediaRepository
     */
    private $media;

    public function __construct(UserRepository $user,SiteSettingsRepository $siteSettings, AlbumRepository $album, MediaRepository $media)
    {

        parent::__construct($user,$siteSettings);
        $this->user = $user;
        $this->siteSettings = $siteSettings;
        $this->album = $album;
        $this->media = $media;
    }

    public function uploadProfilePicture()
    {
        if(Input::hasFile('fileInput'))
        {
            return $this->media->profilePicture(Input::file('fileInput'));
        }
        else
        {
            return false;
        }
    }

    public function uploadCoverPicture()
    {
        if(Input::hasFile('fileInput'))
        {
            return $this->media->coverPicture(Input::file('fileInput'));
        }
        else
        {
            return false;
        }
    }

    public function addWork()
    {
        if(Input::has('company'))
        {
            $work = new Work;
            $work->user_id = Auth::user()->id;
            $company = Company::where('label',Input::get('company'))->first();
            if($company)
            {
                $work->company_id = $company->id;
            }
            else
            {
                $newCompany = new Company;
                $newCompany->label = Input::get('company');
                $newCompany->save();
                $work->company_id = $newCompany->id;
            }
            if(Input::has('position'))
            {
                $position = Position::where('label',Input::get('position'))->first();
                if($position)
                {
                    $work->position_id = $position->id;
                }
                else
                {
                    $newPosition = new Position;
                    $newPosition->label = Input::get('position');
                    $newPosition->save();
                    $work->position_id = $newPosition->id;

                }
            }
            if(Input::has('city'))
            {
                $city = City::where('label',Input::get('city'))->first();
                if($city)
                {
                    $work->city_id = $city->id;
                }
                else
                {
                    $newCity = new City;
                    $newCity->label = Input::get('city');
                    $newCity->save();
                    $work->city_id = $newCity->id;

                }
            }
            if(Input::has('description'))
            {
                $work->desc = Input::get('description');
            }
            if(Input::has('from'))
            {
                $work->from = date("Y-m-d",strtotime(Input::get('from')));
            }
            if(Input::has('to'))
            {
                $work->to = date("Y-m-d",strtotime(Input::get('to')));
            }

            $work->save();
            return Input::all();
        }
        else
        {
            return false;
        }
    }

    public function addHighSchool()
    {
        if(Input::has('school'))
        {
            $highschool = new High_school;
            $highschool->user_id = Auth::user()->id;
            $school = School::where('label',Input::get('school'))->first();
            if($school)
            {
                $highschool->school_id = $school->id;
            }
            else
            {
                $newSchool = new School;
                $newSchool->label = Input::get('school');
                $newSchool->save();
                $highschool->school_id = $newSchool->id;
            }

            if(Input::has('city'))
            {
                $city = City::where('label',Input::get('city'))->first();
                if($city)
                {
                    $highschool->city_id = $city->id;
                }
                else
                {
                    $newCity = new City;
                    $newCity->label = Input::get('city');
                    $newCity->save();
                    $highschool->city_id = $newCity->id;

                }
            }
            if(Input::has('description'))
            {
                $highschool->desc = Input::get('description');
            }
            if(Input::has('graduated'))
            {
                $highschool->graduated = 1;
            }
            else
            {
                $highschool->graduated = 0;
            }
            if(Input::has('from'))
            {
                $highschool->from = date("Y-m-d",strtotime(Input::get('from')));
            }
            if(Input::has('to'))
            {
                $highschool->to = date("Y-m-d",strtotime(Input::get('to')));
            }

            $highschool->save();
            return Input::all();
        }
        else
        {
            return false;
        }
    }

    public function addCollege()
    {
        if(Input::has('school'))
        {
            $college = new College;
            $college->user_id = Auth::user()->id;
            $school = School::where('label',Input::get('school'))->first();
            if($school)
            {
                $college->school_id = $school->id;
            }
            else
            {
                $newSchool = new School;
                $newSchool->label = Input::get('school');
                $newSchool->save();
                $college->school_id = $newSchool->id;
            }

            if(Input::has('city'))
            {
                $city = City::where('label',Input::get('city'))->first();
                if($city)
                {
                    $college->city_id = $city->id;
                }
                else
                {
                    $newCity = new City;
                    $newCity->label = Input::get('city');
                    $newCity->save();
                    $college->city_id = $newCity->id;

                }
            }
            if(Input::has('description'))
            {
                $college->desc = Input::get('description');
            }
            if(Input::has('graduated'))
            {
                $college->graduated = 1;
            }
            else
            {
                $college->graduated = 0;
            }
            if(Input::has('from'))
            {
                $college->from = date("Y-m-d",strtotime(Input::get('from')));
            }
            if(Input::has('to'))
            {
                $college->to = date("Y-m-d",strtotime(Input::get('to')));
            }

            $college->save();
            return Input::all();
        }
        else
        {
            return false;
        }
    }

    public function updatePassword()
    {
        $current_password = Input::get('current_password');
        $new_password = Input::get('new_password');
        $hashedPassword = Auth::user()->password;

        if (Hash::check($current_password, $hashedPassword))
        {
            User::where('id',Auth::user()->id)->update(['password' => Hash::make($new_password)]);
            return Redirect::back()->withPassword_success('success');
        }
        return Redirect::back()->withPassword_error('error');
    }

    public function updateProfile()
    {
        $first_name = Input::get('first_name');
        $last_name = Input::get('last_name');
        $gender = intval(Input::get('gender'));
        $interested_in = Input::get('interested_in');
        if(count($interested_in) == 2)
        {
            $interested_in = 3;
        }
        else
        {
            $interested_in = intval($interested_in[0]);
        }
        User::where('id',Auth::user()->id)->update(['first_name'=>$first_name,'last_name'=>$last_name,'gender'=>$gender,'interested_in' => $interested_in]);
        return Redirect::back()->withProfile_success('success');
    }

    public function forgotPassword()
    {
        return View::make('forgotPassword',$this->layoutData);
    }

    public function forgotPasswordProcess()
    {
        $email = Input::get('email');
        $user = User::where('email',$email)->first();
        if($user)
        {
            $user_meta = Users_meta::where('option','forgot_password')->first();
            if($user_meta)
            {
                $user_meta->value = Hash::make(strval(Carbon::now()));
                $user_meta->save();
            }
            else
            {
                $user_meta = new Users_meta;
                $user_meta->user_id = $user->id;
                $user_meta->option = "forgot_password";
                $user_meta->value = Hash::make(strval(Carbon::now()));
                $user_meta->save();
            }
            $link = URL::Route('resetPassword',['code'=>$user_meta->value]);

            Mail::send('emails.forgotPassword',array('link' => $link), function($message) use ($user)
            {
                $message->to($user->email,$user->first_name." ".$user->last_name)->subject('Phasebook: Reset Password Link');
            });
            return Redirect::back()->with('flash_success','success');
        }
        return Redirect::back()->with('flash_error','User doesnt exist, try again!');
    }

    public function resetPassword($code)
    {
        $user_meta = Users_meta::where('option','forgot_password')->where('value',$code)->first();
        if($user_meta)
        {
            $this->layoutData['code'] = $code;
            return View::make('resetPassword',$this->layoutData);
        }
        return Redirect::route('root');
    }

    public function resetPasswordProcess()
    {
        $code = Input::get('code');
        $password = Input::get('password');
        $user_meta = Users_meta::where('option','forgot_password')->where('value',$code)->first();
        if($user_meta)
        {
            Users_meta::where('option','forgot_password')->where('value',$code)->delete();
            $user = User::where('id',$user_meta->user_id)->update(['password'=>Hash::make($password)]);
        }
        return Redirect::route('root');
    }
}