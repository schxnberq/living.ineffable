<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['id', 'name', 'items', 'img', 'shared_with', 'created_at', 'updated_at'];

    public function user() {
    	return $this->belongsTo(User::class)->select(['id', 'username']);
    }
}
