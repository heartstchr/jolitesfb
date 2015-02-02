<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Original_post extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "original_posts";

    public function post()
    {
        return $this->belongsTo('Post')->where('deleted_at', NULL);
    }
}