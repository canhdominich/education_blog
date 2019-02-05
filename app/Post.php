<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillter = ['id', 'title', 'thumbnail', 'description', 'content', 'slug', 'user_id', 'category_id', 'view_count'];

	public function categories(){
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

	public function post_tags(){
		return $this->hasMany('App\PostTag');
	}

	public function comments(){
		return $this->hasMany('App\Comment');
	}

	// public function users(){
	// 	return $this->belongsToMany('App\User', 'comments', 'user_id', 'post_id');
	// }

	public function users(){
		return $this->belongsTo('App\User', 'user_id');
	}
}
