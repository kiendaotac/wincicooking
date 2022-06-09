<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostResourceCollection;
use App\Http\Resources\RecipeResourceCollection;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\PostRepository;
use App\Repositories\Contracts\RecipeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $categoryRepository, $postRepository, $recipeRepository;
    public function __construct(CategoryRepository $categoryRepository, RecipeRepository $recipeRepository, PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->recipeRepository = $recipeRepository;
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CategoryCollection
     */
    public function index()
    {
        $category = $this->categoryRepository->all();

        return new CategoryCollection($category);
    }

    public function getRecipeIdeas(Request $request)
    {
        return new RecipeResourceCollection($this->recipeRepository->getRecipeIdeas());
    }

    public function getCategoryIdeas(Request $request)
    {
        return new CategoryCollection($this->categoryRepository->getCategoryIdeas());
    }

    public function getFeaturedArticles(Request $request)
    {
        return new PostResourceCollection($this->postRepository->getFeaturedArticles());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
