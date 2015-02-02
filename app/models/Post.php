<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Post extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "posts";

    public function user()
    {
        return $this->belongsTo('User')->with('profilePicture');
    }

    public function originalPost()
    {
        return $this->hasOne('Original_post')->where('deleted_at', NULL);
    }

    public function sharedPost()
    {
        return $this->hasOne('Shared_post')->with('originalPost')->where('deleted_at', NULL);
    }

    public function attachments()
    {
        return $this->hasMany('Attachment')->with('media')->where('deleted_at', NULL);
    }

    public function likes()
    {
        return $this->morphMany('Like', 'likeable')->with('user');
    }

    public function comments()
    {
        return $this->morphMany('Comment','commentable')->with('user');
    }

}