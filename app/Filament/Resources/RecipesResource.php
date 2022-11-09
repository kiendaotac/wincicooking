<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipesResource\Pages;
use App\Filament\Resources\RecipesResource\RelationManagers;
use App\Models\Recipe;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class RecipesResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'Công thức nấu ăn';

    protected static ?string $pluralLabel = 'Công thức nấu ăn';

    public static function form(Form $form): Form
    {
        return $form->schema(RecipesResource\Form::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categories.title')->label('Danh mục')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Tên món ăn')->searchable()->sortable()->limit(20),
                Tables\Columns\TextColumn::make('description')->label('Mô tả món ăn')->searchable()->sortable()->limit(40),
                Tables\Columns\ImageColumn::make('image')->label('Hình minh hoạ'),
                Tables\Columns\TextColumn::make('order')->label('Thứ tự ưu tiên'),
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
            RelationManagers\DetailsRelationManager::class,
            RelationManagers\IngredientsRelationManager::class,
            RelationManagers\NutritionalRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipes::route('/create'),
            'edit' => Pages\EditRecipes::route('/{record}/edit'),
        ];
    }
}
