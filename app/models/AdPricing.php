<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdPricing extends \Eloquent {
    use SoftDeletingTrait;
    protected $fillable = ['name', 'features', 'validity', 'price'];
    protected $table = "ads_pricing";

    public function ad()
    {
        return $this->belongsTo('Ad', 'id', 'ad_slot')->where('deleted_at', NULL);
    }
}
