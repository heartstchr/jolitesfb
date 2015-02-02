<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class High_school extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "high_schools";

    public function school()
    {
        return $this->hasOne('School','id','school_id');
    }

    public function city()
    {
        return $this->hasOne('City','id','city_id');
    }
}