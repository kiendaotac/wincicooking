<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->map(function ($item) {
            foreach ($item->recipes as $recipe) {
                $recipe->image = asset(Storage::url($recipe->image));
            }

            return $item;
        })->toArray();
    }

    public function with($request): array
    {
        return [
            'code'    => 200,
            'success' => true,
            'message' => 'Thông tin category'
        ];
    }
}
