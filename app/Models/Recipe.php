<?php

namespace App\Models;

use App\Enums\DetailTypeEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function details(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::DETAIL)->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::INGREDIENTS)->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function nutritional(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::NUTRITIONAL)->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function ingredientsNutritional(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::INGREDIENTS_NUTRITIONAL)->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function content(): MorphMany
    {
        return $this->morphMany(Section::class, 'causer')->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function userLike()
    {
        return $this->belongsToMany(User::class, 'user_like_recipes', 'recipe_id', 'user_id');
    }
}
