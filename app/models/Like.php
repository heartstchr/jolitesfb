<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Like extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];
    protected $table = "likes";

    public function user()
    {
        return $this->belongsTo('User');
    }

}