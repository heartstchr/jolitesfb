<?php


namespace Facebook\Repositories\Eloquent;

use Carbon\Carbon;
use DateTime;
use ExpressiveDate;
use Facebook\Repositories\UserRepositoryInterface;
use Facebook\Services\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Input;
use URL;
use User;
use Users_meta;

class UserRepository extends AbstractRepository implements UserRepositoryInterface {

    protected $model;

    function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get logged in user
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function getUser($id)
    {
        // TODO: Implement getUser() method.
    }

    /**
     * Get user by id
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function getUserById($id)
    {
        // TODO: Implement getUserById() method.
    }

    /**
     * Get user's status
     *
     * @param $id
     * @return int
     */
    public function getStatus($id)
    {
        // TODO: Implement getStatus() method.
    }

    /**
     * Create new user
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function register($data)
    {
        $userValidator = UserValidator::make($data)->addContext('register');
        if($userValidator->passes()){
            $date = mktime(0, 0, 0, intval($data['month']), intval($data['day']), intval($data['year']));//mktime(hour,minute,second,month,day,year)
            $dob = date("Y-m-d", $date);
            $user = new User;
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->dob = $dob;
            $user->gender = ($data['gender'] === "male")?1:2;
            $user->interested_in = ($data['gender'] === "male")?2:1;
            $user->email = $data['email'];
            $user->password = Hash::make(strval($data['password']));
            $user->save();

            $user_meta = new Users_meta;
            $user_meta->user_id = $user->id;
            $user_meta->option = "activation_key";
            $user_meta->value = Hash::make(strval(Carbon::now()));
            $user_meta->save();

            $activationLink = URL::route('activate')."?email=".$user->email."&code=".$user_meta->value;

            Mail::send('emails.activation',array('activationLink' => $activationLink,'name' => Input::get('first_name')." ".Input::get('last_name'),'email' => Input::get('email')), function($message)
            {
                $message->to(Input::get('email'),Input::get('first_name')." ".Input::get('last_name'))->subject('Just one more step to get started on Phasebook');
            });
            return true;

        }else{
            $this->errors = $userValidator->errors();
            return false;
        }

    }

    /**
     * Activates a account
     *
     * @param array $data
     * @return bool
     */
    public function activate($data)
    {
        $userValidator = UserValidator::make($data)->addContext('activate');
        if($userValidator->passes())
        {
            $user = User::where('email',Input::get('email'))->first();
            $activation_key = Users_meta::where('user_id',$user->id)->where('option','activation_key')->pluck('value');
            if($activation_key == Input::get('code')){
                Users_meta::where('user_id',$user->id)->where('option','activation_key')->delete();
                Auth::login($user);
                User::where('email',Input::get('email'))->update(['status' => 2]);
                return true;
            }
            else
            {
                $this->errors = 'Activation Code Does\'nt match';
                return false;
            }
        }
        else
        {
            $this->errors = $userValidator->errors();
            return false;
        }
    }

    /**
     * create user meta data
     *
     * @param $option
     * @param $value
     * @return bool
     */
    public function createMeta($option, $value)
    {
        $meta = new Users_meta;
        $meta->user_id = Auth::user()->id;
        $meta->option = $option;
        $meta->value = $value;
        $meta->save();
        return true;
    }

    /**
     * update user meta data
     *
     * @param $option
     * @param $value
     * @return bool
     */
    public function updateMeta($option, $value)
    {
        $meta = Users_meta::where('user_id',Auth::user()->id)->where('option',$option)->update(['value' => $value]);
        return true;
    }

    /**
     * Login user
     *
     * @param $data
     * @return \Illuminate\Database\Eloquent\Collection|\User
     */
    public function login($data)
    {
        if(Input::has('email') && Input::has('password'))
        {
            if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}