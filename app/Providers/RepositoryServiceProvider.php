<?php

namespace App\Providers;

use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\CommentRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\RecipeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CategoryRepository::class, \App\Repositories\Eloquent\CategoryRepository::class);
        $this->app->bind(RecipeRepository::class, \App\Repositories\Eloquent\RecipeRepository::class);
        $this->app->bind(PostRepository::class, \App\Repositories\Eloquent\PostRepository::class);
        $this->app->bind(CommentRepository::class, \App\Repositories\Eloquent\RecipeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
