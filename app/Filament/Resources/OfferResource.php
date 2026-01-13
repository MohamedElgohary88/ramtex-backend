<?php

namespace App\Filament\Resources;

use App\Enums\OfferStatus;
use App\Filament\Resources\InvoiceResource;
use App\Filament\Resources\OfferResource\Pages;
use App\Models\Offer;
use App\Models\Product;
use App\Services\OfferService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfferResource extends Resource
{
    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Offer Details')
                    ->description('Client, offer number, date, and status')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\TextInput::make('offer_number')
                            ->label('Offer Number')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto-generated')
                            ->helperText('Offer number is automatically generated upon creation')
                            ->suffixIcon('heroicon-o-hashtag')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->relationship('client', 'full_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Select client for this offer')
                            ->suffixIcon('heroicon-o-user')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\DatePicker::make('offer_date')
                            ->label('Offer Date')
                            ->default(now())
                            ->required()
                            ->helperText('Date when offer was issued')
                            ->suffixIcon('heroicon-o-calendar')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(OfferStatus::class)
                            ->default(OfferStatus::DRAFT)
                            ->required()
                            ->helperText('Current offer status')
                            ->suffixIcon('heroicon-o-flag')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 4])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Offer Items')
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
                                            
                                            // Calculate total price immediately
                                            $quantity = (float) ($get('quantity') ?? 1);
                                            $set('total_price', number_format($quantity * $price, 2, '.', ''));

                                            // Trigger totals update
                                            self::updateTotals($set, $get);
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
                                Forms\Components\TextInput::make('total_price')
                                    ->label('Line Total')
                                    ->numeric()
                                    ->prefix('$')
                                    ->disabled()
                                    ->dehydrated()
                                    ->columnSpan(3),
                            ])
                            ->columns(12)
                            ->defaultItems(1)
                            ->minItems(1)
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set, Get $get) => self::updateTotals($set, $get))
                            ->addActionLabel('Add Item')
                            ->reorderable(false)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Totals & Notes')
                    ->description('VAT, totals calculation, and additional notes')
                    ->icon('heroicon-o-calculator')
                    ->schema([
                        Forms\Components\TextInput::make('vat_rate')
                            ->label('VAT Rate')
                            ->numeric()
                            ->suffix('%')
                            ->default(11)
                            ->helperText('VAT percentage to apply')
                            ->reactive()
                            ->afterStateUpdated(fn (Set $set, Get $get) => self::updateTotals($set, $get))
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\TextInput::make('total_amount')
                                    ->label('Subtotal')
                                    ->numeric()
                                    ->prefix('$')
                                    ->readOnly()
                                    ->helperText('Total before VAT'),
                                Forms\Components\TextInput::make('vat_amount')
                                    ->label('VAT Amount')
                                    ->numeric()
                                    ->prefix('$')
                                    ->readOnly()
                                    ->helperText('Calculated VAT'),
                                Forms\Components\TextInput::make('grand_total')
                                    ->label('Grand Total')
                                    ->numeric()
                                    ->prefix('$')
                                    ->readOnly()
                                    ->helperText('Final amount including VAT')
                                    ->extraInputAttributes(['class' => 'font-bold text-lg']),
                            ])
                            ->columnSpan(['md' => 1]),
                        
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Any special terms, conditions, or remarks for this offer...')
                            ->helperText('Optional: Additional notes to appear on offer')
                            ->rows(3)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(['md' => 2])
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
        $total = $quantity * $unitPrice;
        $set('total_price', number_format($total, 2, '.', ''));
    }

    public static function updateTotals(Set $set, Get $get): void
    {
        $items = $get('items') ?? [];
        $subtotal = 0;

        foreach ($items as $item) {
            $qty = (float) ($item['quantity'] ?? 0);
            $price = (float) ($item['unit_price'] ?? 0);
            $subtotal += $qty * $price;
        }

        $vatRate = (float) ($get('vat_rate') ?? 0);
        $vatAmount = $subtotal * ($vatRate / 100);
        $grandTotal = $subtotal + $vatAmount;

        $set('total_amount', number_format($subtotal, 2, '.', ''));
        $set('vat_amount', number_format($vatAmount, 2, '.', ''));
        $set('grand_total', number_format($grandTotal, 2, '.', ''));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('offer_number')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('client.full_name') // Using full_name accessor if available, or just name
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('offer_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('grand_total')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(OfferStatus::class),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('convert_to_invoice')
                    ->label('Convert to Invoice')
                    ->icon('heroicon-o-check-circle') // Changed icon to be more valid
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Offer $record) => $record->status !== OfferStatus::CONVERTED)
                    ->action(function (Offer $record, OfferService $service) {
                        try {
                            $invoice = $service->convertOfferToInvoice($record);
                            
                            Notification::make()
                                ->title('Success')
                                ->body("Offer converted to Invoice #{$invoice->invoice_number}")
                                ->success()
                                ->send();
                            
                            return redirect(InvoiceResource::getUrl('edit', ['record' => $invoice]));

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Error')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('offer_date', 'desc');
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
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
