<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General Information')
                    ->description('Manage client personal and contact details')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->required()
                            ->maxLength(255)
                            ->label('Full Name')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('company_name')
                            ->maxLength(255)
                            ->label('Company Name')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('job_title')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'M.' => 'M.',
                                'Mr.' => 'Mr.',
                                'Mrs.' => 'Mrs.',
                                'Miss.' => 'Miss.',
                            ])
                            ->searchable()
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('other_phone')
                            ->tel()
                            ->maxLength(255)
                            ->label('Alternative Phone')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('fax')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Forms\Components\Section::make('Address & Location')
                    ->description('Client address and geographic details')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->maxLength(65535)
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('city')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('district')
                            ->maxLength(255)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('pobox')
                            ->maxLength(255)
                            ->label('PO Box')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('country')
                            ->maxLength(255)
                            ->default('Lebanon')
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Forms\Components\Section::make('Financial Information')
                    ->description('Tax and banking details')
                    ->schema([
                        Forms\Components\TextInput::make('financial_number')
                            ->maxLength(255)
                            ->label('MOF / Tax ID')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('bank_details')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('other_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fax')
                    ->searchable(),
                Tables\Columns\TextColumn::make('financial_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank_details')
                    ->searchable(),
                Tables\Columns\TextColumn::make('city')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pobox')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelationManagers\FinancialTransactionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
