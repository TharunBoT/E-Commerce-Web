<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Product Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Product Name')
                    ->required(),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(Product::class, 'slug'),

                Forms\Components\Textarea::make('short_description')
                    ->label('Short Description')
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required(),

                Forms\Components\TextInput::make('regular_price')
                    ->label('Regular Price')
                    ->required()
                    ->numeric(),

                Forms\Components\TextInput::make('sale_price')
                    ->label('Sale Price')
                    ->numeric(),

                Forms\Components\TextInput::make('SKU')
                    ->label('SKU')
                    ->unique(Product::class, 'SKU')
                    ->required(),

                Forms\Components\Select::make('stock_status')
                    ->label('Stock Status')
                    ->options([
                        'instock' => 'In Stock',
                        'outofstock' => 'Out of Stock',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->default(1)
                    ->numeric()
                    ->required(),

                Forms\Components\Toggle::make('featured')
                    ->label('Featured')
                    ->default(false),

                Forms\Components\FileUpload::make('image')
                    ->label('Main Image')
                    ->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),

                Forms\Components\Select::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('regular_price')
                    ->label('Price')
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable(),
                Tables\Columns\BooleanColumn::make('stock_status')
                    ->label('Stock')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
