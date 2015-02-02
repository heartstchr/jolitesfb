<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Shared_post extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "shared_posts";

    public function post()
    {
        return $this->belongsTo('Post')->where('deleted_at', NULL);
    }

    public function originalPost()
    {
        return $this->belongsTo('Post', 'original_post_id')->with('originalPost', 'attachments', 'likes', 'comments')->where('deleted_at', NULL);
    }
}