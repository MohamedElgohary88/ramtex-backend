<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Purchasing';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Company Information')
                    ->description('Supplier company details and tax information')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Forms\Components\TextInput::make('company_name')
                            ->label('Company Name')
                            ->placeholder('ABC Trading Co.')
                            ->helperText('Official registered business name')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-building-office-2')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('full_name')
                            ->label('Contact Person')
                            ->required()
                            ->placeholder('John Doe')
                            ->helperText('Primary contact person at supplier')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-user')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('financial_number')
                            ->label('Tax/VAT Number')
                            ->placeholder('12345678')
                            ->helperText('Tax registration or VAT identification number')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-identification')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 3])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Contact Details')
                    ->description('Email and phone contact information')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->placeholder('supplier@example.com')
                            ->helperText('Primary email for communication')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-envelope')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('+961 1 234567')
                            ->helperText('Primary contact phone number')
                            ->maxLength(255)
                            ->suffixIcon('heroicon-o-phone')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Address')
                    ->description('Physical location and mailing address')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Forms\Components\TextInput::make('address_line_1')
                            ->label('Address Line 1')
                            ->placeholder('123 Main Street')
                            ->helperText('Street address or building name')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('address_line_2')
                            ->label('Address Line 2')
                            ->placeholder('Suite 400')
                            ->helperText('Optional: Apartment, floor, or unit')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('city')
                            ->label('City')
                            ->placeholder('Beirut')
                            ->helperText('City or town')
                            ->maxLength(255)
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 3])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Settings & Notes')
                    ->description('Supplier status and additional notes')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Status')
                            ->default(true)
                            ->helperText('Inactive suppliers won\'t appear in purchase forms')
                            ->inline(false)
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Any internal notes about this supplier...')
                            ->helperText('Optional: Terms, payment preferences, or other important information')
                            ->rows(3)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(['md' => 1])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Contact')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('city')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->boolean()
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only')
                    ->native(false),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('company_name');
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
