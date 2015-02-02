<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Friend extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "friends";

    public function user()
    {
        return $this->belongsTo('User','user_one_id','id');
    }

}