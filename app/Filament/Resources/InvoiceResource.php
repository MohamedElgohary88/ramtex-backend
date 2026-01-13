<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Sales';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->description('Client, invoice number, and date information')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->relationship('client', 'full_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Select client for this invoice or create a new one')
                            ->suffixIcon('heroicon-o-user')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('full_name')
                                    ->required()
                                    ->label('Full Name'),
                                Forms\Components\TextInput::make('company_name')
                                    ->label('Company Name'),
                                Forms\Components\TextInput::make('phone')
                                    ->label('Phone')
                                    ->tel(),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email(),
                            ])
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('invoice_number')
                            ->label('Invoice Number')
                            ->default(fn () => Invoice::generateInvoiceNumber())
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Invoice number is auto-generated but can be customized')
                            ->suffixIcon('heroicon-o-hashtag')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\DatePicker::make('invoice_date')
                            ->label('Invoice Date')
                            ->default(now())
                            ->required()
                            ->helperText('Date when invoice was issued')
                            ->suffixIcon('heroicon-o-calendar')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 3])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Invoice Items')
                    ->description('Products, quantities, and pricing')
                    ->icon('heroicon-o-shopping-cart')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Product')
                                    ->options(Product::query()->where('is_active', true)->pluck('name', 'id'))
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function (Set $set, Get $get, $state) {
                                        if ($state) {
                                            $product = Product::find($state);
                                            $price = $product?->price ?? 0;
                                            $set('unit_price', $price);
                                            
                                            // Calculate total line price immediately
                                            $quantity = (float) ($get('quantity') ?? 1);
                                            $set('total_line_price', number_format($quantity * $price, 2, '.', ''));
                                        }
                                    })
                                    ->columnSpan(4),
                                Forms\Components\TextInput::make('quantity')
                                    ->label('Qty')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateLineTotal($set, $get))
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('unit_price')
                                    ->label('Unit Price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('$')
                                    ->reactive()
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateLineTotal($set, $get))
                                    ->columnSpan(3),
                                Forms\Components\TextInput::make('total_line_price')
                                    ->label('Line Total')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),
                            ])
                            ->columns(12)
                            ->defaultItems(1)
                            ->addActionLabel('Add Item')
                            ->reorderable(false)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Totals & Notes')
                    ->description('VAT rate and additional notes')
                    ->icon('heroicon-o-calculator')
                    ->schema([
                        Forms\Components\TextInput::make('vat_rate')
                            ->label('VAT Rate')
                            ->numeric()
                            ->suffix('%')
                            ->default(11)
                            ->helperText('VAT percentage to apply to invoice total')
                            ->suffixIcon('heroicon-o-percent-badge')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Any special terms, conditions, or remarks for this invoice...')
                            ->helperText('Optional: Additional notes to appear on invoice')
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

    public static function updateLineTotal(Set $set, Get $get): void
    {
        $quantity = (float) ($get('quantity') ?? 0);
        $unitPrice = (float) ($get('unit_price') ?? 0);
        $set('total_line_price', number_format($quantity * $unitPrice, 2, '.', ''));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('client.full_name')
                    ->searchable()
                    ->sortable()
                    ->label('Client'),
                Tables\Columns\TextColumn::make('invoice_date')
                    ->date('d/m/Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'posted' => 'success',
                        'cancelled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('grand_total')
                    ->money('USD')
                    ->sortable()
                    ->label('Total'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Created By')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'posted' => 'Posted',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'full_name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn (Invoice $record): bool => $record->isDraft()),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
