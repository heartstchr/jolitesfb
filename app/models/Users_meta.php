<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Users_meta extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "users_meta";

}