<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::group(['middleware' => 'filter'], function() {
// 	Route::get('/', 'PostController@index');
// 	Route::get('/{slug}', 'BlogController@post');
// });

// posts
Route::get('/', 'BlogController@index');

Route::get('/{slug}', 'BlogController@post');

// tags
Route::get('/tags/{slug}', 'BlogController@tag');

//category
Route::get('/categories/{slug}', 'BlogController@category');

//search
Route::get('/search/{key}', 'BlogController@search');

//about
Route::get('/tags/{slug}', 'BlogController@tag');

Route::get('/about/details', function(){
	return view('about');
});

// Route::get('/', 'PostController@index');
// Route::get('/{slug}', 'BlogController@post');


Route::group(['prefix' => 'admin'], function () {
	// user
	Route::resource('user', 'UserController');

	// category
	Route::resource('category', 'CategoryController');
	Route::post('/update_category', 'CategoryController@edit');
	Route::get('/new/category', function(){
		return view('category.new_category');
	});

	// post
	Route::resource('post', 'PostController');
	Route::get('/new/post', function(){
		return view('post.new_post');
	});

	// tag
	Route::resource('tag', 'TagController');
	Route::get('/new/tag', function(){
		return view('tag.new_tag');
	});

});
