<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Trend';

    protected static ?string $description = 'Daily revenue over the last 30 days';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 2;

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::query(Invoice::where('status', 'posted'))
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->sum('grand_total');

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue',
                    'data' => $data->map(fn (TrendValue $value) => round($value->aggregate, 2)),
                    'fill' => 'start',
                    'borderColor' => 'rgb(245, 158, 11)', // Amber
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'tension' => 0.4,
                    'pointBackgroundColor' => 'rgb(245, 158, 11)',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 3,
                    'pointHoverRadius' => 5,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => \Carbon\Carbon::parse($value->date)->format('M d')),
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
                    'display' => false,
                ],
                'tooltip' => [
                    'enabled' => true,
                    'mode' => 'index',
                    'intersect' => false,
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => 'rgba(245, 158, 11, 0.5)',
                    'borderWidth' => 1,
                    'padding' => 12,
                    'displayColors' => false,
                    'callbacks' => [
                        'label' => 'function(context) { return "$" + context.parsed.y.toFixed(2); }',
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
                        'maxRotation' => 0,
                        'autoSkip' => true,
                        'maxTicksLimit' => 8,
                    ],
                    'border' => [
                        'display' => false,
                    ],
                ],
            ],
            'interaction' => [
                'mode' => 'nearest',
                'axis' => 'x',
                'intersect' => false,
            ],
        ];
    }
}
