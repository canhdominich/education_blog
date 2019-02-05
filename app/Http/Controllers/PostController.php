<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'asc');
        return view('post.posts_list', ['posts' => $posts->paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('thumbnail')){
            $request->thumbnail->store('public/uploads');
            $fileName = $request->thumbnail->hashName();
            $data['thumbnail'] = $fileName;
        }

        $data['slug'] = str_slug($data['title']);

        $data['user_id'] = 1;
        $data['view_count'] = 0;

        // lay ra chuoi id cua tag, sau do tach ra cac gia tri cho vao mang tags_id
        $tags_id = explode(',', $data['tags']);

        unset($data['_token']);
        unset($data['tags']);
        $post = Post::create($data);

        $post_id = $post->id;

        if(!empty($tags_id)){
            $posts_tag['post_id'] = $post_id;
            for($i = 0; $i<sizeof($tags_id); $i++){
                $posts_tag['tag_id'] = $tags_id[$i];
                PostTag::create($posts_tag);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $post = Post::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $post->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_tags = Post::findOrFail($id)->post_tags()->delete();
        $post = Post::findOrFail($id)->delete();
    }
}
