<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResourceCollection;
use App\Repositories\Contracts\RecipeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function like(Request $request)
    {
        if ($request->action == 'like') {
            Auth::user()->likes()->attach($request->payload);
            return [
                'code'    => 200,
                'success' => true,
                'message' => 'Like bài viết thành công'
            ];
        } elseif($request->action == 'unlike') {
            Auth::user()->likes()->detach($request->payload);
            return [
                'code'    => 200,
                'success' => true,
                'message' => 'Unlike bài viết thành công'
            ];
        }

        return [
            'code'    => 200,
            'success' => false,
            'message' => 'Chưa xác định hành động'
        ];
    }

    public function likes(Request $request, RecipeRepository $recipeRepository)
    {
        return new RecipeResourceCollection($recipeRepository->userLikes());
    }
}
