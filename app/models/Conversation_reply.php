<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Conversation_reply extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "conversation_replies";

    public function conversation(){
        return $this->hasOne('Conversation');
    }

}