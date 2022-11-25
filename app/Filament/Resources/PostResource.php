<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    protected static ?string $pluralLabel = "Bài viết";

    protected static ?string $label = "Bài viết";


    public static function form(Form $form): Form
    {
        return $form->schema(PostResource\Form::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categories.title')->label('Danh mục')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Tên món ăn')->searchable()->sortable()->limit(20),
                Tables\Columns\TextColumn::make('description')->label('Mô tả món ăn')->searchable()->sortable()->limit(40),
                Tables\Columns\ImageColumn::make('image')->label('Hình minh hoạ'),
                Tables\Columns\BadgeColumn::make('status')->label('Trạng thái')->colors([
                    'primary',
                    'danger' => 'INACTIVE',
                    'success' => 'ACTIVE',
                ])
            ])
            ->filters([
                //
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::class,
            RelationManagers\ContentRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
