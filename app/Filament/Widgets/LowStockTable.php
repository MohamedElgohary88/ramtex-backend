<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockTable extends BaseWidget
{
    protected static ?string $heading = 'Low Stock Alert';

    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '400px';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->whereColumn('stock_on_hand', '<=', 'min_stock_alert')
                    ->orderBy('stock_on_hand')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Product')
                    ->searchable()
                    ->weight('medium')
                    ->description(fn (Product $record): string => $record->sku ?? ''),

                Tables\Columns\TextColumn::make('stock_on_hand')
                    ->label('Stock')
                    ->numeric()
                    ->color('danger')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('min_stock_alert')
                    ->label('Min')
                    ->numeric()
                    ->color('warning'),
            ])
            ->paginated(false)
            ->striped();
    }
}
