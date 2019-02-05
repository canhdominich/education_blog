<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('updated_at', 'desc');
        return view('category.categories_list', ['categories' => $categories->paginate(4)]);
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
        $request->thumbnail->store('public/uploads');
        // dd($request->thumbnail->getClientOriginalName());
        $fileName = $request->thumbnail->hashName();
        $data = $request->all();
        unset($data['_token']);
        unset($data['image']);
        $data['slug'] = str_slug($data['name']);
        $data['thumbnail'] = $fileName;
        $category = Category::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        if($request->hasFile('thumbnail')){
            $request->thumbnail->store('public/uploads');
            $fileName = $request->thumbnail->hashName();
            $data['thumbnail'] = $fileName;
        }
        else{
            unset($data['thumbnail']);
        }
        $data['slug'] = str_slug($data['name']);
        $category = Category::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $category->update($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $category = Category::find($data['id']);
        unset($data['_token']);
        unset($data['id']);
        $category->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     $posts = Category::findOrFail($id)->posts()->delete();
     $category = Category::findOrFail($id)->delete();
 }
}
