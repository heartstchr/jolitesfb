<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Album extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "albums";

    public function user()
    {
        return $this->belongsTo('User')->where('deleted_at', NULL);
    }

    public function medias()
    {
        return $this->hasMany('Media')->where('deleted_at', NULL);
    }

    public function firstPic()
    {
        return $this->hasOne('Media')->orderBy('created_at','desc');
    }
}
