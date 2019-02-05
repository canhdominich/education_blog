<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['id', 'name', 'slug'];

	public function posts(){
		return $this->belongsToMany('App\Post');
	}

	public function post_tags(){
		return $this->hasMany('App\PostTags');
	}
}
