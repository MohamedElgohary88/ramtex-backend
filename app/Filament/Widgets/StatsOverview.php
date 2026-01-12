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

    protected function getStats(): array
    {
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

        $totalReceivables = Invoice::where('status', 'posted')->sum('grand_total')
            - Receipt::sum('amount');

        $lowStockCount = Product::whereColumn('stock_on_hand', '<=', 'min_stock_alert')->count();
        $totalClients = Client::count();
        $draftInvoices = Invoice::where('status', 'draft')->count();

        return [
            Stat::make('Revenue', '$' . number_format($currentMonthRevenue, 2))
                ->description($revenueChange >= 0 ? "+{$revenueChange}% from last month" : "{$revenueChange}% from last month")
                ->descriptionIcon($revenueChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([7, 3, 4, 5, 6, 3, 5, 8]) // Sparkline
                ->color($revenueChange >= 0 ? 'success' : 'danger'),

            Stat::make('Receivables', '$' . number_format(max(0, $totalReceivables), 2))
                ->description('Outstanding balance')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),

            Stat::make('Active Clients', number_format($totalClients))
                ->description('Total registered clients')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Draft Invoices', $draftInvoices)
                ->description('Pending approval')
                ->descriptionIcon('heroicon-m-document-text')
                ->color($draftInvoices > 5 ? 'warning' : 'gray'),

            Stat::make('Low Stock', $lowStockCount)
                ->description('Products need reorder')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStockCount > 0 ? 'danger' : 'success'),

            Stat::make('Products', Product::count())
                ->description('Total SKUs')
                ->descriptionIcon('heroicon-m-cube')
                ->color('gray'),
        ];
    }
}
