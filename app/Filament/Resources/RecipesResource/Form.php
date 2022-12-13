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

    public static function getIngredientsForm(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\TextInput::make('title')->label('Thành phần')
                    ->required()
                    ->placeholder('Thành phần'),
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

    public static function getNutritionalForm(): array
    {
        return [
            Forms\Components\Grid::make(1)->schema([
                Forms\Components\Repeater::make('nutritional')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required(),
                        Forms\Components\TextInput::make('ration')->required(),
                        Forms\Components\TextInput::make('rni')
                    ])
                    ->createItemButtonLabel('Thêm thành phần dinh dưỡng')
                    ->label('Thành phần dinh dưỡng'),
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

    public static function getContentForm()
    {
        return [
            Forms\Components\TextInput::make('title')->label('Tiêu đề')->required(),
            Forms\Components\FileUpload::make('image')->label('Hình ảnh')->image()->required(),
            Forms\Components\Textarea::make('content')->label('Nội dung')->required(),
            Forms\Components\TextInput::make('order')->label('Thứ tự')->numeric()->default(0),
            Forms\Components\Select::make('status')->label('Trạng thái')
                ->required()
                ->default(StatusEnum::ACTIVE)
                ->options(StatusEnum::VALUE)
                ->searchable()
                ->disablePlaceholderSelection(),
        ];
    }

    public static function getIngredientsNutritionForm(): array
    {
        return [
            Forms\Components\Card::make([
                Forms\Components\TextInput::make('name')->label('Tên thành phần dinh dưỡng')
                    ->required()
                    ->placeholder('Tên thành phần'),
                Forms\Components\TextInput::make('value')->label('Giá trị')->numeric()->default(0)->required(),
                Forms\Components\ColorPicker::make('color')->default('#2a9d8f'),
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