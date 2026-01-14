<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurrencyResource\Pages;
use App\Models\Currency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $modelLabel = 'Currency';

    protected static ?string $pluralModelLabel = 'Currencies';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Currency Details')
                    ->description('Define how this currency behaves throughout the system.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Currency Name')
                            ->required()
                            ->maxLength(120)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('code')
                            ->label('ISO Code')
                            ->required()
                            ->maxLength(3)
                            ->minLength(3)
                            ->rule('alpha')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (?string $state, Set $set) => $set('code', strtoupper($state ?? '')))
                            ->helperText('3-letter ISO currency code (e.g., USD, EUR, LBP).')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('symbol')
                            ->label('Symbol')
                            ->maxLength(8)
                            ->default('$')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('exchange_rate')
                            ->label('Exchange Rate')
                            ->numeric()
                            ->required()
                            ->default(1.0000)
                            ->step(0.0001)
                            ->helperText('Value of 1 unit of this currency in terms of the base currency.')
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('decimal_precision')
                            ->label('Decimal Precision')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(4)
                            ->default(2)
                            ->helperText('Number of decimal places to show when formatting amounts.')
                            ->columnSpan(1),
                        Forms\Components\Toggle::make('is_base')
                            ->label('Base Currency')
                            ->helperText('Only one currency can be marked as base at a time.')
                            ->inline(false)
                            ->columnSpan(1),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false)
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Forms\Components\Section::make('Sync Metadata')
                    ->description('Track where the latest exchange rate originated from.')
                    ->schema([
                        Forms\Components\TextInput::make('sync_source')
                            ->label('Source')
                            ->maxLength(255)
                            ->placeholder('Fixer.io, Manual Entry, ...')
                            ->columnSpan(2),
                        Forms\Components\DateTimePicker::make('last_synced_at')
                            ->label('Last Synced At')
                            ->seconds(false)
                            ->columnSpan(1),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('symbol')
                    ->label('Symbol')
                    ->sortable(),
                Tables\Columns\TextColumn::make('exchange_rate')
                    ->label('Rate')
                    ->numeric(decimalPlaces: 4)
                    ->sortable(),
                Tables\Columns\TextColumn::make('decimal_precision')
                    ->label('Precision')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_base')
                    ->label('Base')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_base')->label('Base Currency'),
                Tables\Filters\TernaryFilter::make('is_active')->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('is_base', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCurrencies::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderByDesc('is_base')->orderBy('name');
    }
}
