<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Comment extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = ['content','user_id','commentable_id','commentable_type'];
    protected $table = "comments";

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

}