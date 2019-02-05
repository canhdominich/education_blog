<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Post;
use App\Tag;

use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!\App::runningInConsole()){
            View::share('categories', Category::all());
            View::share('tags', Tag::all());

            $new_posts = Post::orderBy('created_at', 'desc')->take(4)->get();
            View::share('new_posts', $new_posts);

            $popular_posts = Post::orderBy('view_count', 'desc')->take(5)->get();
            View::share('popular_posts', $popular_posts);

            $popular_tags = Tag::orderBy('created_at', 'desc')->take(15)->get();
            View::share('popular_tags', $popular_tags);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
