<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Site_setting extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "site_settings";

}