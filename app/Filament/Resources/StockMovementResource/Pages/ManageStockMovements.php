<?php

namespace App\Filament\Resources\StockMovementResource\Pages;

use App\Filament\Resources\StockMovementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Notifications\Notification;

class ManageStockMovements extends ManageRecords
{
    protected static string $resource = StockMovementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Adjustment')
                ->using(function (array $data): ?\Illuminate\Database\Eloquent\Model {
                    try {
                        $service = app(\App\Services\StockService::class);
                        $product = \App\Models\Product::find($data['product_id']);
                        
                        return $service->adjustStock(
                            product: $product,
                            quantity: (int) $data['quantity'],
                            type: $data['type'],
                            user: auth()->user(),
                            notes: $data['notes'] ?? null
                        );
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Stock Error')
                            ->body($e->getMessage())
                            ->danger()
                            ->persistent()
                            ->send();
                        
                        return null;
                    }
                })
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Stock Updated')
                        ->body('Stock movement recorded successfully.')
                ),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Resources\StockMovementResource\Widgets\StockMovementStats::class,
        ];
    }
}
