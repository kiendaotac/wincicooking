<?php

namespace App\Filament\Resources\RecipesResource\RelationManagers;

use App\Enums\DetailTypeEnum;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\BelongsToManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;

class NutritionalRelationManager extends BelongsToManyRelationManager
{
    protected static string $relationship = 'nutritional';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = DetailTypeEnum::VALUE[DetailTypeEnum::NUTRITIONAL];

    public static function form(Form $form): Form
    {
        return $form->schema(\App\Filament\Resources\RecipesResource\Form::getNutritionalForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Giá trị dinh dưỡng'),
            ])
            ->filters([
                //
            ]);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $newData = [];
        foreach ($data['nutritional'] as $item) {
            if (empty($newData)) {
                $newData = $item;
            } else {
                $newData['childen'][] = $item;
            }
        }

        return ['title'   => $newData['name'],
                'content' => $newData,
                'type'    => DetailTypeEnum::NUTRITIONAL,
                'order'   => $data['order'],
                'status'  => $data['status']
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $content[] = [
            'name'   => $data['content']['name'] ?? '',
            'ration' => $data['content']['ration'] ?? '',
            'rni'    => $data['content']['rni'] ?? ''
        ];
        foreach ($data['content']['childen'] ?? [] as $item) {
            $content[] = $item;
        }

        return [
            'nutritional' => $content,
            'order'       => $data['order'],
            'status'      => $data['status']
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $newData = [];
        foreach ($data['nutritional'] as $item) {
            if (empty($newData)) {
                $newData = $item;
            } else {
                $newData['childen'][] = $item;
            }
        }

        return ['title'   => $newData['name'],
                'content' => $newData,
                'type'    => DetailTypeEnum::NUTRITIONAL,
                'order'   => $data['order'],
                'status'  => $data['status']
        ];
    }

    public static function getTitleForRecord(Model $ownerRecord): string
    {
        return DetailTypeEnum::VALUE[DetailTypeEnum::NUTRITIONAL];
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
