<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InvoicesChart extends ChartWidget
{
    protected static ?string $heading = 'Invoice Volume';

    protected static ?string $description = 'Daily invoice count over the last 30 days';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = Trend::model(Invoice::class)
            ->between(
                start: now()->subDays(30),
                end: now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Invoices Created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => 'rgb(34, 197, 94)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderRadius' => 6,
                    'borderWidth' => 2,
                    'hoverBackgroundColor' => 'rgb(22, 163, 74)',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => \Carbon\Carbon::parse($value->date)->format('M d')),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
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
                    'borderColor' => 'rgba(34, 197, 94, 0.5)',
                    'borderWidth' => 1,
                    'padding' => 12,
                    'displayColors' => false,
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
                        'stepSize' => 1,
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
                        'maxTicksLimit' => 10,
                    ],
                    'border' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
