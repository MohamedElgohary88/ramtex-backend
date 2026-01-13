<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class MonthlyComparisonChart extends ChartWidget
{
    protected static ?string $heading = 'Year-over-Year Comparison';

    protected static ?string $description = 'Monthly revenue comparison with previous year';

    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 2;

    protected static ?string $maxHeight = '300px';

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
                    'label' => "{$currentYear} Revenue",
                    'data' => array_map(fn ($m) => round($currentYearData[$m] ?? 0, 2), range(1, 12)),
                    'borderColor' => 'rgb(245, 158, 11)',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.4,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 5,
                    'pointBackgroundColor' => 'rgb(245, 158, 11)',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                ],
                [
                    'label' => "{$lastYear} Revenue",
                    'data' => array_map(fn ($m) => round($lastYearData[$m] ?? 0, 2), range(1, 12)),
                    'borderColor' => 'rgb(107, 114, 128)',
                    'backgroundColor' => 'transparent',
                    'borderDash' => [5, 5],
                    'tension' => 0.4,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 5,
                    'pointBackgroundColor' => 'rgb(107, 114, 128)',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
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
            'responsive' => true,
            'maintainAspectRatio' => true,
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                    'labels' => [
                        'color' => 'rgba(156, 163, 175, 0.9)',
                        'usePointStyle' => true,
                        'pointStyle' => 'circle',
                        'padding' => 16,
                        'font' => [
                            'size' => 12,
                            'weight' => '500',
                        ],
                    ],
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => 'rgba(156, 163, 175, 0.3)',
                    'borderWidth' => 1,
                    'padding' => 12,
                    'callbacks' => [
                        'label' => 'function(context) { return context.dataset.label + ": $" + context.parsed.y.toFixed(2); }',
                    ],
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid' => [
                        'display' => true,
                        'color' => 'rgba(156, 163, 175, 0.1)',
                        'drawBorder' => false,
                    ],
                    'ticks' => [
                        'color' => 'rgba(156, 163, 175, 0.7)',
                        'font' => [
                            'size' => 11,
                        ],
                        'callback' => 'function(value) { return "$" + value; }',
                    ],
                    'border' => [
                        'display' => false,
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                        'drawBorder' => false,
                    ],
                    'ticks' => [
                        'color' => 'rgba(156, 163, 175, 0.7)',
                        'font' => [
                            'size' => 11,
                        ],
                    ],
                    'border' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
