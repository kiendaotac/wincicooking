<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use JsonSerializable;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        $recipe            = parent::toArray($request);
        $recipe['image']   = asset(Storage::url($recipe['image']));
        $recipe['content'] = new SectionResourceCollection($this->whenLoaded('content'));
        $recipe['liked']   = Auth::user()->likes()->whereId($this->id)->count() > 0;

        return $recipe;
    }
}
