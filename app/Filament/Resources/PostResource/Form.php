<?php

namespace App\Filament\Resources\PostResource;

use App\Enums\DetailTypeEnum;
use App\Enums\StatusEnum;
use Filament\Forms;

class Form
{
    public static function getForm(): array
    {
        return [
            Forms\Components\Card::make()->schema([
                Forms\Components\TextInput::make('title')->label('Tên bài viết')->required(),
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

    public static function getContentForm(): array
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
}