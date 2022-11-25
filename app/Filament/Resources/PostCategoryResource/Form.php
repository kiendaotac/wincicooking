<?php

namespace App\Filament\Resources\PostCategoryResource;

use App\Enums\StatusEnum;
use App\Models\PostCategory;
use Filament\Forms;

class Form
{
    public static function getForm()
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\Select::make('parent_id')->label('Danh mục cha')
                    ->options(PostCategory::all()->pluck('title', 'id'))
                    ->searchable(),
                Forms\Components\TextInput::make('title')->label('Tên danh mục')->required(),
                Forms\Components\Textarea::make('description')->label('Mô tả danh mục')->required(),
                Forms\Components\TextInput::make('order')->numeric()->minValue(0)->required()->label('Thứ tự')->default(0),
                Forms\Components\Select::make('status')->label('Trạng thái')
                    ->required()
                    ->default(StatusEnum::ACTIVE)
                    ->options(StatusEnum::VALUE)
                    ->disablePlaceholderSelection()
            ])
        ];
    }
}