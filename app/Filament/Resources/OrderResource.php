<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Orders Section';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('s_name')
                    ->label('Shipping Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('s_phone')
                    ->label('Shipping Phone')
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('s_address')
                    ->label('Shipping Address')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('s_landmark')
                    ->label('Landmark')
                    ->nullable()
                    ->maxLength(255),

                Forms\Components\TextInput::make('s_city')
                    ->label('City')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('s_country')
                    ->label('Country')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('s_state')
                    ->label('State')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('s_zip')
                    ->label('Zip Code')
                    ->required()
                    ->maxLength(20),

                Forms\Components\TextInput::make('total_amount')
                    ->label('Total Amount')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->formatStateUsing(fn ($state) => number_format($state, 2))
                    ->prefix('$'),

                Forms\Components\Select::make('payment_status')
                    ->label('Payment Status')
                    ->required()
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Failed' => 'Failed',
                        // Add other statuses if needed
                    ])
                    ->placeholder('Select payment status'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('Order ID')
                ->sortable(),
                
            Tables\Columns\TextColumn::make('s_name')
                ->label('Shipping Name')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_phone')
                ->label('Shipping Phone')
                ->sortable(),
                
            Tables\Columns\TextColumn::make('s_address')
                ->label('Shipping Address')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_landmark')
                ->label('Landmark')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_city')
                ->label('City')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_country')
                ->label('Country')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_state')
                ->label('State')
                ->sortable(),

            Tables\Columns\TextColumn::make('s_zip')
                ->label('Zip Code')
                ->sortable(),

            Tables\Columns\TextColumn::make('total_amount')
                ->label('Total Amount')
                ->sortable()
                ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),

            Tables\Columns\TextColumn::make('payment_status')
                ->label('Payment Status')
                ->sortable(),
                
            Tables\Columns\TextColumn::make('products')
                ->label('Products')
                ->formatStateUsing(function ($state) {
                    // Decode the JSON and extract the product details
                    $products = json_decode($state, true);
            
                    // Extract product names and quantities
                    $productDetails = array_map(
                        fn($product) => $product['name'] . ' (Qty: ' . $product['qty'] . ')',
                        $products
                    );
            
                    // Join the details into a single string
                    return implode(', ', $productDetails);
                }),
            

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
