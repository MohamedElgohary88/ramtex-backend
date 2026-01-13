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
                // Basic Information Section
                Forms\Components\Section::make('Basic Information')
                    ->description('Client name, company, and role details')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->required()
                            ->placeholder('John Smith')
                            ->helperText('The primary contact person\'s full name')
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\Select::make('gender')
                            ->label('Title / Gender')
                            ->options([
                                'Mr.' => 'Mr.',
                                'Mrs.' => 'Mrs.',
                                'Miss.' => 'Miss',
                                'M.' => 'M.',
                            ])
                            ->searchable()
                            ->placeholder('Select title')
                            ->helperText('Professional title or gender prefix')
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('company_name')
                            ->label('Company Name')
                            ->placeholder('Startups Inc.')
                            ->helperText('Optional: Client company or organization name')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('job_title')
                            ->label('Job Title')
                            ->placeholder('CEO, Manager, etc.')
                            ->helperText('Optional: Position or role in company')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                // Contact Information Section
                Forms\Components\Section::make('Contact Information')
                    ->description('Email, phone numbers, and communication channels')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->placeholder('client@example.com')
                            ->helperText('Primary email for invoices and communication')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-envelope')
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+961 1 234567')
                            ->helperText('Primary contact phone number')
                            ->required()
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-phone')
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('other_phone')
                            ->label('Alternative Phone')
                            ->tel()
                            ->placeholder('+961 3 987654')
                            ->helperText('Optional: Secondary contact number')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-phone')
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('fax')
                            ->label('Fax Number')
                            ->placeholder('+961 1 234568')
                            ->helperText('Optional: Fax number if applicable')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                // Address & Location Section
                Forms\Components\Section::make('Address & Location')
                    ->description('Physical address and location details')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\Textarea::make('address')
                            ->label('Street Address')
                            ->placeholder('Building name, street, area...')
                            ->helperText('Full street address including building/floor details')
                            ->maxLength(65535)
                            ->rows(3)
                            ->columnSpanFull(),
                        
                        Forms\Components\TextInput::make('city')
                            ->label('City')
                            ->placeholder('Beirut')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('district')
                            ->label('District / Area')
                            ->placeholder('Hamra, Achrafieh, etc.')
                            ->helperText('Neighborhood or district name')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('pobox')
                            ->label('PO Box')
                            ->placeholder('P.O. Box 1234')
                            ->helperText('Optional: Postal box number')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('country')
                            ->label('Country')
                            ->default('Lebanon')
                            ->placeholder('Lebanon')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                // Financial Information Section
                Forms\Components\Section::make('Financial & Legal Information')
                    ->description('Tax ID, bank details, and financial records')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('financial_number')
                            ->label('Tax ID / MOF Number')
                            ->placeholder('Enter tax registration number')
                            ->helperText('Ministry of Finance tax registration or VAT number')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\TextInput::make('bank_details')
                            ->label('Bank Account Details')
                            ->placeholder('Bank name, IBAN, SWIFT, etc.')
                            ->helperText('Optional: Bank information for payments and receipts')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),
            ])
            ->columns(1);
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
