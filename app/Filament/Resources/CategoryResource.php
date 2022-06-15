<?php

namespace App\Filament\Resources;

use App\Enums\StatusEnum;
use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Select::make('parent_id')->label('Danh mục cha')
                            ->options(Category::all()->pluck('title', 'id'))
                            ->searchable(),
                        Forms\Components\TextInput::make('title')->label('Tên danh mục')->required(),
                        Forms\Components\Textarea::make('description')->label('Mô tả danh mục')->required(),
                        Forms\Components\TextInput::make('order')->numeric()->minValue(0)->required()->label('Thứ tự')->default(0),
                        Forms\Components\Select::make('status')->label('Trạng thái')
                            ->required()
                            ->default(StatusEnum::ACTIVE)
                            ->options(StatusEnum::VALUE)
                            ->disablePlaceholderSelection()
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent.title')->label('Danh mục cha')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('title')->label('Tên danh mục')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Mô tả')->searchable(),
                Tables\Columns\TextColumn::make('order')->label('Thứ tự sắp xếp')->sortable()
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
