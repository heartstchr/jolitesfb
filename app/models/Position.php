<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Position extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "positions";


}