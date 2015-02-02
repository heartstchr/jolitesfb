<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Notification extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = "notifications";

    public function user()
    {
        return $this->belongsTo('User');
    }
}