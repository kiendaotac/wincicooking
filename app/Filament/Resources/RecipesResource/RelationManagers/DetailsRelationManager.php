<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use App\Enums\DetailTypeEnum;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class DetailsRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'details';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(\App\Filament\Resources\RecipesResource\Form::getDetailForm());
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return[
            'title' => DetailTypeEnum::DETAIL_VALUE[$data['content']],
            'content' => [
                'name' => DetailTypeEnum::DETAIL_VALUE[$data['content']],
                'type' => $data['content'],
                'value' => $data['value']
            ],
            'type' => DetailTypeEnum::DETAIL,
            'order' => $data['order']
        ];
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tên'),
                Tables\Columns\TextColumn::make('value')->label('Giá trị'),
                Tables\Columns\ViewColumn::make('icon')->label('Icon')->view('tables.columns.icon')
            ])
            ->filters([
                //
            ]);
    }

    public static function getTitleForRecord(Model $ownerRecord): string
    {
        return 'Chi tiết';
    }
}
