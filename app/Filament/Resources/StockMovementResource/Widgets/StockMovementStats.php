<?php

declare(strict_types=1);

namespace App\Filament\Resources\StockMovementResource\Widgets;

use App\Models\StockMovement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StockMovementStats extends BaseWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        
        return [
            Stat::make('Movements Today', StockMovement::whereDate('created_at', $today)->count())
                ->description('Total stock changes today')
                ->icon('heroicon-o-arrow-path'),
            Stat::make('Stock In Today', StockMovement::whereDate('created_at', $today)->where('type', 'in')->sum('quantity'))
                ->description('Units received')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray'),
            Stat::make('Stock Out Today', StockMovement::whereDate('created_at', $today)->where('type', 'out')->sum('quantity'))
                ->description('Units shipped/sold')
                ->color('danger')
                ->icon('heroicon-o-arrow-up-tray'),
        ];
    }
}
