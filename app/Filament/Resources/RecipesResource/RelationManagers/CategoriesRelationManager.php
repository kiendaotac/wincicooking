<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class CategoriesRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'categories';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Resources\RecipesResource\Form::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Tên danh mục')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('parent.title')->label('Danh mục cha')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->label('Mô tả danh mục')->limit(30),
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
}
