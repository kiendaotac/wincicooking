<?php

namespace App\Filament\Resources\RecipesResource;

use App\Enums\DetailTypeEnum;
use App\Enums\StatusEnum;
use Filament\Forms;

class Form
{
    public static function getForm(): array
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('title')->label('Tên công thức')->required(),
                Forms\Components\Textarea::make('description')->label('Mô tả ngắn')->required(),
                Forms\Components\Grid::make([
                    'default' => 3
                ])->schema([
                    Forms\Components\FileUpload::make('image')->label('Ảnh hiển thị')->image()->required(),
                    Forms\Components\TextInput::make('order')->label('Thứ tự ưu tiên')->numeric()->default(0),
                    Forms\Components\Select::make('status')->label('Trạng thái')
                        ->required()
                        ->default(StatusEnum::ACTIVE)
                        ->options(StatusEnum::VALUE)
                        ->searchable()
                        ->disablePlaceholderSelection()
                ])
            ])
        ];
    }

    public static function getDetailForm(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\Select::make('content')->label('Thể loại')
                    ->required()
                    ->options(DetailTypeEnum::DETAIL_VALUE)
                    ->default('TYPE')
                    ->searchable(false)
                    ->disablePlaceholderSelection(),
                Forms\Components\TextInput::make('value')->label('Giá trị')
                ->required()
                ->placeholder('Giá trị'),
                Forms\Components\TextInput::make('order')->label('Thứ tự')->numeric()->default(0)->required(),
                Forms\Components\Select::make('status')->label('Trạng thái')
                    ->required()
                    ->default(StatusEnum::ACTIVE)
                    ->options(StatusEnum::VALUE)
                    ->searchable()
                    ->disablePlaceholderSelection()
            ])
        ];
    }
}