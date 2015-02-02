<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Conversation extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "conversations";


    public function last_message(){
        return $this->hasOne('Conversation_reply')->orderBy('updated_at','desc');
    }

    public function user_one(){
        return $this->belongsTo('User','user_one_id')->with('profilePicture');
    }

    public function user_two(){
        return $this->belongsTo('User','user_two_id')->with('profilePicture');
    }

}