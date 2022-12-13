<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use App\Enums\DetailTypeEnum;
use App\Enums\StatusEnum;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class IngredientsNutritionalRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'ingredientsNutritional';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = DetailTypeEnum::VALUE[DetailTypeEnum::INGREDIENTS_NUTRITIONAL];

    public static function form(Form $form): Form
    {
        return $form->schema(\App\Filament\Resources\RecipesResource\Form::getIngredientsNutritionForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tên thành phần')
                    ->getStateUsing(function (Model $record) {
                        return $record->content['name'];
                    }),
                TextColumn::make('value')
                    ->label('Giá trị')
                    ->getStateUsing(function (Model $record) {
                        return $record->content['value'];
                    }),
                TextColumn::make('color')
                    ->label('Màu sắc')
                    ->getStateUsing(function (Model $record) {
                        return '<div style="border-radius: 5px; width: 30px; height: 30px; background: '.$record->content['color'].'"></div>';
                    })
                    ->html()
            ])
            ->filters([
                //
            ]);
    }

    public static function getTitleForRecord(Model $ownerRecord): string
    {
        return DetailTypeEnum::VALUE[DetailTypeEnum::INGREDIENTS_NUTRITIONAL];
    }

    protected function canAttach(): bool
    {
        return false;
    }

    protected function canDetach(Model $record): bool
    {
        return false;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return [
            'title'   => DetailTypeEnum::VALUE[DetailTypeEnum::INGREDIENTS_NUTRITIONAL],
            'content' => [
                'name'  => $data['name'] ?? 'Tên thành phần',
                'value' => $data['value'] ?? 0,
                'color' => $data['color'] ?? '#2a9d8f'
            ],
            'type'    => DetailTypeEnum::INGREDIENTS_NUTRITIONAL,
            'order'   => $data['order'] ?? 0,
            'status'  => $data['status'] ?? StatusEnum::ACTIVE
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return [
            'title'   => DetailTypeEnum::VALUE[DetailTypeEnum::INGREDIENTS_NUTRITIONAL],
            'content' => [
                'name'  => $data['name'] ?? 'Tên thành phần',
                'value' => $data['value'] ?? 0,
                'color' => $data['color'] ?? '#2a9d8f'
            ],
            'type'    => DetailTypeEnum::INGREDIENTS_NUTRITIONAL,
            'order'   => $data['order'] ?? 0,
            'status'  => $data['status'] ?? StatusEnum::ACTIVE
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name']  = $data['content']['name'] ?? 'Tên thành phần';
        $data['value'] = $data['content']['value'] ?? 0;
        $data['color'] = $data['content']['color'] ?? '#c3c3c3';

        return $data;
    }
}
