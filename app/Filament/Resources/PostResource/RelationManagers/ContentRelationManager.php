<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\MorphManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class ContentRelationManager extends MorphManyRelationManager
{
    protected static string $relationship = 'content';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema(\App\Filament\Resources\PostResource\Form::getContentForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Tên đầu mục')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('image')->label('Hình ảnh'),
                Tables\Columns\TextColumn::make('content')->label('Mô tả')->limit(40),
                Tables\Columns\TextColumn::make('order')->label('Thứ tự')->sortable()
            ])
            ->filters([
                //
            ]);
    }

    public static function getTitleForRecord(Model $ownerRecord): string
    {
        return 'Nội dung bài viết';
    }
}
