<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTags extends Model
{
	protected $fillable = ['post_id', 'tag_id'];
	protected $table = "post_tags";

	public function tags(){
		return $this->belongsTo('App\Tag', 'id');
	}

	public function posts(){
		return $this->belongsTo('App\Post', 'id');
	}
}
