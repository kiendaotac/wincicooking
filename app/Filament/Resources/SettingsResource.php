<?php

namespace App\Filament\Resources;

use App\Enums\SettingsEnum;
use App\Enums\StatusEnum;
use App\Filament\Resources\SettingsResource\Pages;
use App\Filament\Resources\SettingsResource\RelationManagers;
use App\Models\Settings;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingsResource extends Resource
{
    protected static ?string $model = Settings::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Tên settings')
                    ->required(),
                Forms\Components\Select::make('type')
                    ->label('Loại settings')
                    ->options(\App\Enums\SettingsEnum::TYPE)
                    ->disablePlaceholderSelection()
                    ->required()
                    ->default(SettingsEnum::LOGO),
                Forms\Components\Select::make('data_type')
                    ->label('Loại dữ liệu')
                    ->options(SettingsEnum::DATA_TYPE)
                    ->default(SettingsEnum::IMAGE)
                    ->required()
                    ->afterStateUpdated(function (callable $set) {
                        $set('value', null);
                    })
                    ->disablePlaceholderSelection()
                    ->reactive(),
                Forms\Components\TextInput::make('value')
                    ->label('Nội dung')
                    ->required()
                    ->disabled(function (callable $get) {
                        $dataType = $get('data_type');
                        return $dataType !== SettingsEnum::TEXT;
                    })
                    ->hidden(function (callable $get) {
                        $dataType = $get('data_type');
                        return $dataType !== SettingsEnum::TEXT;
                    }),
                Forms\Components\FileUpload::make('value')
                    ->label('Hình ảnh')
                    ->image()
                    ->required()
                    ->hidden(function (callable $get) {
                        $dataType = $get('data_type');
                        return $dataType !== SettingsEnum::IMAGE;
                    })
                    ->disabled(function (callable $get) {
                        $dateType = $get('data_type');
                        return $dateType !== SettingsEnum::IMAGE;
                    }),
                Forms\Components\Select::make('status')
                    ->label('Trạng thái')
                    ->options(StatusEnum::VALUE)
                    ->default(StatusEnum::ACTIVE)
                    ->disablePlaceholderSelection()
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Tên settings'),
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Loại settings')
                    ->colors([
                        'primary',
                        'success' => SettingsEnum::LOGO,
                    ]),
                Tables\Columns\ViewColumn::make('value')
                    ->view('tables.columns.dynamic')
                    ->viewData([
                        'data_type' => '2'
                    ])
                    ->label('Nội dung'),
                Tables\Columns\BadgeColumn::make('data_type')
                    ->label('Loại dữ liệu')
                    ->colors([
                    'primary',
                    'danger' => SettingsEnum::TEXT,
                    'success' => SettingsEnum::IMAGE,
                ]),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'primary',
                        'danger'  => 'INACTIVE',
                        'success' => 'ACTIVE',
                    ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSettings::route('/'),
        ];
    }
}
