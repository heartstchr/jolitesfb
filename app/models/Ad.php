<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Ad extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = [];
    protected $table = "ads";

    public function user()
    {
        return $this->belongsTo('User')->where('deleted_at', NULL);
    }

    public function pricing()
    {
        return $this->hasOne('AdPricing', 'id', 'ad_slot')->where('deleted_at', NULL);
    }
}
