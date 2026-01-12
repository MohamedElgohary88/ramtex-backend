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
                    ->columnSpanFull() // Ensure full width
                    ->columns(3)
                    ->schema([
                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'full_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('full_name')->required(),
                                Forms\Components\TextInput::make('company_name'),
                                Forms\Components\TextInput::make('phone'),
                                Forms\Components\TextInput::make('email')->email(),
                            ]),
                        Forms\Components\TextInput::make('invoice_number')
                            ->default(fn () => Invoice::generateInvoiceNumber())
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('invoice_date')
                            ->default(now())
                            ->required(),
                    ]),

                Forms\Components\Section::make('Invoice Items')
                    ->columnSpanFull() // Ensure full width
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
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->minValue(1)
                                    ->reactive()
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateLineTotal($set, $get))
                                    ->columnSpan(2),
                                Forms\Components\TextInput::make('unit_price')
                                    ->numeric()
                                    ->required()
                                    ->prefix('$')
                                    ->reactive()
                                    ->afterStateUpdated(fn (Set $set, Get $get) => self::updateLineTotal($set, $get))
                                    ->columnSpan(3),
                                Forms\Components\TextInput::make('total_line_price')
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
                            ->cloneable(),
                    ]),

                Forms\Components\Section::make('Totals & Notes')
                    ->columnSpanFull() // Ensure full width
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('vat_rate')
                            ->numeric()
                            ->suffix('%')
                            ->default(11)
                            ->label('VAT Rate'),
                        Forms\Components\Textarea::make('notes')
                            ->rows(3),
                    ]),
            ]);
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
