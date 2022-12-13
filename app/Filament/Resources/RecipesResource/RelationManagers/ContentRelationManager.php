<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use App\Enums\DetailTypeEnum;
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

    protected static ?string $title = 'Nội dung công thức';

    protected static ?string $label = 'Nội dung công thức';


    public static function form(Form $form): Form
    {
        return $form->schema(\App\Filament\Resources\RecipesResource\Form::getContentForm());
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
        return 'Nội dung công thức';
    }
}
