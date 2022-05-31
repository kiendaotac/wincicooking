<?php

namespace App\Models;

use App\Enums\DetailTypeEnum;
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
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::DETAIL);
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::INGREDIENTS);
    }

    public function nutritional(): BelongsToMany
    {
        return $this->belongsToMany(Detail::class)->where('type', DetailTypeEnum::NUTRITIONAL);
    }

    public function content(): MorphMany
    {
        return $this->morphMany(Section::class, 'causer')->orderBy('order');
    }
}
