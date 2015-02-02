<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class City extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "cities";

}