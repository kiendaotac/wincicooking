<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\RecipeResourceCollection;
use App\Repositories\Contracts\CategoryRepository;
use App\Repositories\Contracts\RecipeRepository;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public $recipeRepository, $categoryRepository;

    public function __construct(RecipeRepository $recipeRepository, CategoryRepository $categoryRepository)
    {
        $this->recipeRepository = $recipeRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return RecipeResourceCollection
     */
    public function index(): RecipeResourceCollection
    {
        return new RecipeResourceCollection($this->recipeRepository->all());
    }

    public function getRecipeByCategory(Request $request)
    {
        return new CategoryCollection($this->categoryRepository->getRecipeByCategory());
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
     * @param int $id
     * @return RecipeResource
     */
    public function show(int $id): RecipeResource
    {
        return new RecipeResource($this->recipeRepository->show($id));
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
