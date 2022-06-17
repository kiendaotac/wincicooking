<?php

namespace App\Repositories\Eloquent;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeRepository implements \App\Repositories\Contracts\RecipeRepository
{

    public function all($paginate = 10)
    {
        return Recipe::query()->with(['categories'])->latest()->paginate($paginate);
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function show($id)
    {
        return Recipe::query()->where('id', $id)->where('status', 'ACTIVE')->with(['details', 'ingredients', 'content', 'categories', 'nutritional', 'ingredientsNutritional'])->firstOrFail();
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function getRecipeIdeas() {
        return Recipe::query()->inRandomOrder()->limit(5)->get();
    }

    public function userLikes()
    {
        return Recipe::whereHas('userLike', function ($q){
            $q->where('id', Auth::id());
        })->paginate(10);
    }
}