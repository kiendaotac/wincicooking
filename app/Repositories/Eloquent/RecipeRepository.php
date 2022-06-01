<?php

namespace App\Repositories\Eloquent;

use App\Models\Recipe;

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
        return Recipe::query()->where('id', $id)->where('status', 'ACTIVE')->with(['details', 'ingredients', 'content', 'categories', 'nutritional'])->firstOrFail();
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}