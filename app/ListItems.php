<?php

namespace App;

use App\Lists;
use Illuminate\Database\Eloquent\Model;

class ListItems extends Model
{
    protected $fillable = ['id', 'user_id', 'lists_id', 'item', 'description', 'created_at', 'updated_at'];

    public function list() 
    {
    	return $this->belongsTo(Lists::class)->select(['id', 'user_id', "name"]);
    }
    public function user() 
    {
    	return $this->belongsTo(User::class)->select(['id', 'username']);
    }
}
