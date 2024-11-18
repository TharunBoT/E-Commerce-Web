<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $navigationGroup = 'Customers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->label('Name'),
                        
                    TextInput::make('email')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->email()
                        ->label('Email Address'),
                        
                    Select::make('usertype')
                        ->required()
                        ->options([
                            'user' => 'User',
                            'admin' => 'Admin',
                        ])
                        ->default('user')
                        ->label('User Type'),
                        
                    TextInput::make('password')
                        ->password()
                        ->label('Password')
                        ->maxLength(255)
                        ->required()
                        ->hiddenOn('edit'),
                        
                    FileUpload::make('profile_photo_path')
                        ->label('Profile Photo')
                        ->image()
                        ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->label('ID')
                ->sortable(),
                
            Tables\Columns\TextColumn::make('name')
                ->label('Name')
                ->sortable(),
                
                Tables\Columns\TextColumn::make('email')
                ->label('Email')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
