<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(PostCategory::class, 'category_post', 'category_id', 'post_id', 'id');
    }
    public function content(): MorphMany
    {
        return $this->morphMany(Section::class, 'causer')->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }

    public function getImageAttribute($value): string
    {
        return asset(Storage::url($value));
    }
}
