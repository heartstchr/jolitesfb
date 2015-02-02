<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Follow extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "follows";

    public function user()
    {
        return "ajay";
    }
}