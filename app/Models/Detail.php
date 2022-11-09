<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'type', 'order', 'status'];

    protected $casts = [
        'content' => 'array'
    ];

    protected function name(): Attribute
    {
        return Attribute::get(function ($value, $attribute){
            $value = $attribute['content'];
            return json_decode($value)->name ?? '';
        });
    }

    protected function value(): Attribute
    {
        return Attribute::get(function ($value, $attribute){
            $value = $attribute['content'];
            return json_decode($value)->value ?? '';
        });
    }

    protected function icon(): Attribute
    {
        return Attribute::get(function ($value, $attribute){
            $value = $attribute['content'];
            return json_decode($value)->icon ?? 'account-download';
        });
    }

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
