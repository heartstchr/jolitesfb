<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class School extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "schools";

}