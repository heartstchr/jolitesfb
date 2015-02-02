<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Company extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "companies";



}