<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryContract;

class CategoryRepository implements CategoryRepositoryContract
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
        // TODO: Implement show() method.
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