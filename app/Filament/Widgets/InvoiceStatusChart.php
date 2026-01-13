<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;

class InvoiceStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Invoice Status Distribution';
    
    protected static ?string $description = 'Breakdown of invoices by status';

    protected static ?int $sort = 7;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $statuses = Invoice::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $posted = $statuses['posted'] ?? 0;
        $draft = $statuses['draft'] ?? 0;
        $cancelled = $statuses['cancelled'] ?? 0;
        $total = $posted + $draft + $cancelled;

        return [
            'datasets' => [
                [
                    'data' => [$posted, $draft, $cancelled],
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',   // Green for Posted
                        'rgb(245, 158, 11)',  // Amber for Draft
                        'rgb(239, 68, 68)',   // Red for Cancelled
                    ],
                    'borderColor' => '#ffffff',
                    'borderWidth' => 3,
                    'hoverOffset' => 8,
                ],
            ],
            'labels' => [
                "Posted ({$posted})", 
                "Draft ({$draft})", 
                "Cancelled ({$cancelled})"
            ],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
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
                    'backgroundColor' => 'rgba(0, 0, 0, 0.8)',
                    'titleColor' => '#ffffff',
                    'bodyColor' => '#ffffff',
                    'borderColor' => 'rgba(156, 163, 175, 0.3)',
                    'borderWidth' => 1,
                    'padding' => 12,
                    'displayColors' => true,
                    'callbacks' => [
                        'label' => 'function(context) { 
                            var label = context.label || "";
                            var value = context.parsed || 0;
                            var total = context.dataset.data.reduce((a, b) => a + b, 0);
                            var percentage = ((value / total) * 100).toFixed(1);
                            return label + ": " + percentage + "%";
                        }',
                    ],
                ],
            ],
            'cutout' => '65%',
        ];
    }
}
