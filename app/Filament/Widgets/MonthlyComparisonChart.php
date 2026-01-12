<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyComparisonChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Comparison';

    protected static ?string $description = 'Revenue vs. last year';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;

        $getData = fn (int $year) => Invoice::query()
            ->where('status', 'posted')
            ->whereYear('invoice_date', $year)
            ->selectRaw('MONTH(invoice_date) as month, SUM(grand_total) as total')
            ->groupByRaw('MONTH(invoice_date)')
            ->pluck('total', 'month')
            ->toArray();

        $currentYearData = $getData($currentYear);
        $lastYearData = $getData($lastYear);

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        return [
            'datasets' => [
                [
                    'label' => (string) $currentYear,
                    'data' => array_map(fn ($m) => $currentYearData[$m] ?? 0, range(1, 12)),
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                ],
                [
                    'label' => (string) $lastYear,
                    'data' => array_map(fn ($m) => $lastYearData[$m] ?? 0, range(1, 12)),
                    'borderColor' => '#6b7280',
                    'backgroundColor' => 'transparent',
                    'borderDash' => [5, 5],
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'color' => 'rgba(255, 255, 255, 0.7)',
                        'usePointStyle' => true,
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'grid' => [
                        'color' => 'rgba(255, 255, 255, 0.05)',
                    ],
                    'ticks' => [
                        'color' => 'rgba(255, 255, 255, 0.5)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'color' => 'rgba(255, 255, 255, 0.5)',
                    ],
                ],
            ],
        ];
    }
}
