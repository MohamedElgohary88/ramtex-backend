<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PriceListResource\Pages;
use App\Filament\Resources\PriceListResource\RelationManagers;
use App\Models\PriceList;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PriceListResource extends Resource
{
    protected static ?string $model = PriceList::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Price List Details')
                    ->description('Main configuration for this price list')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(['md' => 2]),
                        
                        Forms\Components\Select::make('currency_id')
                            ->relationship('currency', 'code')
                            ->searchable()
                            ->preload()
                            ->label('Currency')
                            ->helperText('Optional: Specific currency for this list')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->columnSpan(['md' => 1])
                            ->inline(false),
                    ])
                    ->columns(['md' => 4])
                    ->columnSpanFull(),

                Forms\Components\Section::make('Products & Prices')
                    ->description('Assign custom prices to specific products')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->hiddenLabel()
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('product_id')
                                    ->label('Product')
                                    ->relationship('product', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('price')
                                    ->label('Custom Price')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->prefix('$') // Assuming base currency for now or matching symbol
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->addActionLabel('Add Product Price')
                            ->reorderableWithButtons(),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('currency.code')
                    ->label('Currency')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('items_count')
                    ->counts('items')
                    ->label('Products Count')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPriceLists::route('/'),
            'create' => Pages\CreatePriceList::route('/create'),
            'edit' => Pages\EditPriceList::route('/{record}/edit'),
        ];
    }
}
