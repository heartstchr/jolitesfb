<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class College extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "colleges";

    public function school()
    {
        return $this->hasOne('School','id','school_id');
    }

    public function city()
    {
        return $this->hasOne('City','id','city_id');
    }
}