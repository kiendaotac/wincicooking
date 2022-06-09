<?php

namespace App\Repositories\Eloquent;

use App\Enums\StatusEnum;
use App\Models\Category;

class CategoryRepository implements \App\Repositories\Contracts\CategoryRepository
{

    public function all($paginate = 10)
    {
        return Category::with('recipes')->simplePaginate($paginate);
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function getCategoryIdeas()
    {
        return Category::query()->inRandomOrder()->limit(5)->get();
    }

    public function getRecipeByCategory()
    {
        return Category::query()->with(['recipes'])->where('status', StatusEnum::ACTIVE)->latest()->get();
    }
}