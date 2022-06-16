<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'title', 'description', 'order', 'status'];

    public function parent()
    {
        return $this->belongsTo(PostCategory::class);
    }
}
