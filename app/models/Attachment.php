<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Attachment extends \Eloquent {
    use SoftDeletingTrait;
	protected $fillable = [];
    protected $table = "attachments";

    public function media()
    {
        return $this->belongsTo('Media')->with('album');
    }

    public function post()
    {
        return $this->belongsTo('Post');
    }
}