<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use App\PostTags;
use Validator;
use App\Events\ViewPostHandler;


class BlogController extends Controller
{
	public function index(){
		$posts = Post::orderBy('id', 'asc');
		return view('index', ['posts' => $posts->paginate(2)]);
	}

	public function category($slug){
		$category = Category::where('slug',$slug)->firstOrFail();
		$posts = Post::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(3);
		return view('index', ['posts' => $posts, 'title' => $category->name]);
	}

	public function tag($slug){
		$tag = Tag::where('slug', $slug)->firstOrFail();
		$post_tags = $tag->post_tags()->get()->unique('post_id');
		if(count($post_tags) > 0){
			$posts = Post::where(function($query) use($post_tags)
			{
				foreach($post_tags as $value)
				{
					$query->orWhere('id', $value->post_id);
				}

			})->orderBy('created_at', 'desc')->paginate(3);

			return view('index', ['posts' => $posts, 'title' => $tag->name]);
		}
		else{
			$posts = null;
			return view('index', ['posts' => $posts, 'title' => $tag->name]);
		}
	}

	public function post($slug){
		$post = Post::where('slug',$slug)->firstOrFail();
		$post_tags = PostTags::where('post_id', $post->id)->get();
		
		$suggest_posts = Post::where('category_id', $post->category_id)->where('id', '!=', $post->id)->orderBy('created_at', 'DESC')->take(3)->get();;

		foreach($post_tags as $value){
			$tags[] = Tag::where('id', $value->tag_id)->get();
		}

		if(!empty($suggest_posts) && !empty($tags)){
			return view('detail', ['post' => $post, 'suggest_posts' => $suggest_posts, 'tags' => array_unique($tags) ]);
		}
		else{
			return view('detail', ['post' => $post]);
		}
	}

	public function search($key){
		$key = str_replace('+', ' ', $key); 

		// $key = preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($key));
		$key = preg_replace('[!@#$%^&*()_\-=\[\]{};\'\:\"\\|,.<>\/?]', '', strip_tags($key));
		
		$data['key'] = $key;
		// validation
		$validator = Validator::make($data,[
			'key' => 'required|min:2|max:255',
		]);

		if($validator->fails()){
			$posts = array();
			return view('search', ['posts' => $posts, 'title' => $data['key'].' - Bloger']);
		}
		else{
			$posts = array();
			$posts = Post::where('title', 'LIKE', '%'.$key.'%')->orWhere('description', 'LIKE', '%'.$key.'%')->paginate(2);
			return view('search', ['posts' => $posts, 'title' => $data['key'].' - Bloger']);
		}		
	}
}
