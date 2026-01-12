<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;

class InvoiceStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Invoice Status';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $statuses = Invoice::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'data' => [
                        $statuses['posted'] ?? 0,
                        $statuses['draft'] ?? 0,
                        $statuses['cancelled'] ?? 0,
                    ],
                    'backgroundColor' => [
                        '#10b981', // emerald
                        '#f59e0b', // amber
                        '#ef4444', // red
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 3,
                ],
            ],
            'labels' => ['Posted', 'Draft', 'Cancelled'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
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
                        'padding' => 20,
                    ],
                ],
            ],
            'cutout' => '70%',
        ];
    }
}
