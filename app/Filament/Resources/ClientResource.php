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
                // الكارد الرئيسي واخد الشاشة كلها
                Forms\Components\Section::make('Client Details')
                    ->description('Manage client personal and contact information')
                    ->schema([
                        // الصف الأول
                        Forms\Components\TextInput::make('company_name')
                            ->label('Company Name')
                            ->placeholder('Startups Inc.')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('job_title')
                            ->label('Job Title')
                            ->maxLength(255),
                        
                        // الصف التاني
                        Forms\Components\Select::make('gender')
                            ->options([
                                'M.' => 'M.',
                                'Mr.' => 'Mr.',
                                'Mrs.' => 'Mrs.',
                                'Miss.' => 'Miss.',
                            ])
                            ->searchable(),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone')
                            ->tel()
                            ->maxLength(255),
                        
                        // الصف التالت
                        Forms\Components\TextInput::make('other_phone')
                            ->label('Alternative Phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('fax')
                            ->label('Fax')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label('City')
                            ->maxLength(255),
                        
                        // Address - عامود كامل
                        Forms\Components\Textarea::make('address')
                            ->label('Address')
                            ->maxLength(65535)
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        // الصف الرابع
                        Forms\Components\TextInput::make('district')
                            ->label('District')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('pobox')
                            ->label('PO Box')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('country')
                            ->label('Country')
                            ->maxLength(255)
                            ->default('Lebanon'),
                        
                        // الصف الخامس - Financial
                        Forms\Components\TextInput::make('financial_number')
                            ->label('MOF / Tax ID')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_details')
                            ->label('Bank Details')
                            ->maxLength(255),
                    ])
                    ->columns(3)
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
