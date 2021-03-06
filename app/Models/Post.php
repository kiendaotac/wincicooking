<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Post extends Model
{
    use HasFactory;

    public function content(): MorphMany
    {
        return $this->morphMany(Section::class, 'causer')->where('status', StatusEnum::ACTIVE)->orderBy('order');
    }
}
