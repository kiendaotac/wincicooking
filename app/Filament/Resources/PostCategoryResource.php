<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\PostCategoryResource\Pages;
use App\Filament\Resources\PostCategoryResource\RelationManagers;
use App\Models\PostCategory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $pluralLabel = "Danh mục bài viết";

    protected static ?string $label = "Danh mục bài viết";

    public static function form(Form $form): Form
    {
        return $form->schema(PostCategoryResource\Form::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent.title')->label('Danh mục cha')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Tên danh mục')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Mô tả')->searchable(),
                Tables\Columns\TextColumn::make('order')->label('Thứ tự sắp xếp')->sortable(),
                Tables\Columns\BadgeColumn::make('status')->label('Trạng thái')->colors([
                    'primary',
                    'danger' => 'INACTIVE',
                    'success' => 'ACTIVE',
                ])
            ])
            ->defaultSort('id', 'asc')
            ->filters([
                //
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPostCategories::route('/'),
            'create' => Pages\CreatePostCategory::route('/create'),
            'edit' => Pages\EditPostCategory::route('/{record}/edit'),
        ];
    }
}
