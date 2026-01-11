<?php

namespace App\Filament\Resources\StockMovementResource\Pages;

use App\Filament\Resources\StockMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStockMovements extends ManageRecords
{
    protected static string $resource = StockMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Adjustment')
                ->using(function (array $data): \Illuminate\Database\Eloquent\Model {
                    // Use the StockService to handle the creation safely
                    $service = app(\App\Services\StockService::class);
                    $product = \App\Models\Product::find($data['product_id']);
                    
                    return $service->adjustStock(
                        product: $product,
                        quantity: (int) $data['quantity'],
                        type: $data['type'], // 'in', 'out', 'adjustment'
                        user: auth()->user(),
                        notes: $data['notes'] ?? null
                    );
                }),
        ];
    }
}
