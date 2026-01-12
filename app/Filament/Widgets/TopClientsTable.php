<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\FinancialTransaction;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class TopClientsTable extends BaseWidget
{
    protected static ?string $heading = 'Top Clients by Revenue';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    protected static ?string $maxHeight = '400px';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Client::query()
                    ->withSum(['financialTransactions as total_revenue' => function (Builder $query) {
                        $query->where('type', 'debit');
                    }], 'amount')
                    ->orderByDesc('total_revenue')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Client')
                    ->searchable()
                    ->weight('medium')
                    ->description(fn (Client $record): string => $record->city ?? ''),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Revenue')
                    ->money('USD')
                    ->sortable()
                    ->color('success')
                    ->weight('bold'),
            ])
            ->paginated(false)
            ->striped();
    }
}
