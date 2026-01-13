<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Receipt;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Calculate current and previous month revenue
        $currentMonthRevenue = Invoice::where('status', 'posted')
            ->whereMonth('invoice_date', now()->month)
            ->whereYear('invoice_date', now()->year)
            ->sum('grand_total');

        $lastMonthRevenue = Invoice::where('status', 'posted')
            ->whereMonth('invoice_date', now()->subMonth()->month)
            ->whereYear('invoice_date', now()->subMonth()->year)
            ->sum('grand_total');

        $revenueChange = $lastMonthRevenue > 0 
            ? round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1)
            : 0;

        // Calculate total receivables (outstanding balance)
        $totalReceivables = Invoice::where('status', 'posted')->sum('grand_total')
            - Receipt::sum('amount');

        // Get product and client metrics
        $lowStockCount = Product::whereColumn('stock_on_hand', '<=', 'min_stock_alert')->count();
        $totalClients = Client::count();
        $draftInvoices = Invoice::where('status', 'draft')->count();
        $totalProducts = Product::count();
        
        // Get last 7 days revenue trend for sparkline
        $revenueTrend = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dailyRevenue = Invoice::where('status', 'posted')
                ->whereDate('invoice_date', $date)
                ->sum('grand_total');
            $revenueTrend[] = (float) $dailyRevenue;
        }

        return [
            Stat::make('Monthly Revenue', '$' . number_format($currentMonthRevenue, 2))
                ->description($revenueChange >= 0 
                    ? "+{$revenueChange}% from last month" 
                    : "{$revenueChange}% from last month"
                )
                ->descriptionIcon($revenueChange >= 0 
                    ? 'heroicon-m-arrow-trending-up' 
                    : 'heroicon-m-arrow-trending-down'
                )
                ->chart($revenueTrend)
                ->color($revenueChange >= 0 ? 'success' : 'danger')
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),

            Stat::make('Outstanding Receivables', '$' . number_format(max(0, $totalReceivables), 2))
                ->description('Total unpaid invoices')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($totalReceivables > 10000 ? 'warning' : 'info')
                ->chart([15, 20, 18, 22, 24, 26, 28])
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),

            Stat::make('Active Clients', number_format($totalClients))
                ->description('Total registered clients')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info')
                ->chart([5, 10, 15, 12, 18, 20, $totalClients])
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),

            Stat::make('Draft Invoices', $draftInvoices)
                ->description($draftInvoices > 5 ? 'Needs attention' : 'Under control')
                ->descriptionIcon('heroicon-m-document-text')
                ->color($draftInvoices > 5 ? 'warning' : 'gray')
                ->chart([3, 5, 4, 6, 5, 4, $draftInvoices])
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),

            Stat::make('Low Stock Items', $lowStockCount)
                ->description($lowStockCount > 0 ? 'Products need reorder' : 'All stock levels good')
                ->descriptionIcon($lowStockCount > 0 
                    ? 'heroicon-m-exclamation-triangle' 
                    : 'heroicon-m-check-circle'
                )
                ->color($lowStockCount > 0 ? 'danger' : 'success')
                ->chart([8, 6, 5, 4, 3, 2, $lowStockCount])
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),

            Stat::make('Total Products', number_format($totalProducts))
                ->description('SKUs in inventory')
                ->descriptionIcon('heroicon-m-cube')
                ->color('gray')
                ->chart([50, 60, 70, 75, 80, 85, $totalProducts])
                ->extraAttributes([
                    'class' => 'fi-wi-stats-overview-stat-enhanced',
                ]),
        ];
    }
    
    protected function getColumns(): int
    {
        return 3; // 3 cards per row on desktop
    }
}
