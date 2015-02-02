<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Work extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "works";

    public function company()
    {
        return $this->hasOne('Company','id','company_id');
    }

    public function position()
    {
        return $this->hasOne('Position','id','position_id');
    }

    public function city()
    {
        return $this->hasOne('City','id','city_id');
    }


}