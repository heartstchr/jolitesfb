<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Media extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "media";

    public function userProfilePicture()
    {
        return $this->belongsTo('User','id','profile_pic');
    }


    public function album()
    {
        return $this->belongsTo('Album');
    }

    public function attachments()
    {
        return $this->hasMany('Attachment');
    }

    public function userCoverPicture()
    {
        return $this->belongsTo('User','id','cover_pic');
    }

}