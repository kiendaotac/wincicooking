<?php

namespace App\Repositories\Eloquent;

use App\Enums\StatusEnum;
use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements \App\Repositories\Contracts\CommentRepository
{

    public function addComment($payload)
    {
        return Comment::create([
            'user_id'     => Auth::id(),
            'causer_type' => Recipe::class,
            'causer_id'   => $payload['recipe_id'],
            'content'     => $payload['content'],
            'status'      => StatusEnum::ACTIVE
        ]);
    }
}