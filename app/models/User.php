<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait,SoftDeletingTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     *Returns the profile picture
     *
     * @return array
     */
    public function profilePicture()
    {
        return $this->hasOne('Media','id','profile_pic');
    }

    public function posts()
    {
        return $this->hasMany('Post')->with('originalPost', 'sharedPost', 'attachments', 'likes', 'comments');
    }

    /**
     * Returns the cover picture
     *
     * @return array
     */
    public function coverPicture()
    {
        return $this->hasOne('Media','id','cover_pic');
    }

    public function ads()
    {
        return $this->hasMany('Ad')->with('pricing');
    }

    public function notifications()
    {
        return $this->hasMany('Notification');
    }
}
