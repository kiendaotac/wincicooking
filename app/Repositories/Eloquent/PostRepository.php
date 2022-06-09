<?php

namespace App\Repositories\Eloquent;

use App\Enums\StatusEnum;
use App\Models\Post;

class PostRepository implements \App\Repositories\Contracts\PostRepository
{

    public function all($paginate = 10)
    {
        return Post::query()->latest()->paginate($paginate);
    }

    public function store($data)
    {
        // TODO: Implement store() method.
    }

    public function show($id)
    {
        return Post::query()->where('id', $id)->where('status',StatusEnum::ACTIVE)->with(['content'])->firstOrFail();
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function getFeaturedArticles()
    {
        return Post::query()->inRandomOrder()->limit(5)->get();
    }
}