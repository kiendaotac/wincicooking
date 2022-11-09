<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use App\Enums\DetailTypeEnum;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class IngredientsRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'ingredients';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form->schema(\App\Filament\Resources\RecipesResource\Form::getIngredientsForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Tên nguyên liệu'),
            ])
            ->filters([
                //
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = DetailTypeEnum::INGREDIENTS;

        return $data;
    }

    public static function getTitleForRecord(Model $ownerRecord): string
    {
        return 'Nguyên liệu';
    }

    protected function canAttach(): bool
    {
        return false;
    }

    protected function canDetach(Model $record): bool
    {
        return false;
    }
}
