<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Enums\FinancialTransactionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FinancialTransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'financialTransactions'; // camelCase is cleaner

    protected static ?string $title = 'Account Statement';
    
    protected static ?string $icon = 'heroicon-o-banknotes';

    public function isReadOnly(): bool
    {
        return true; // Use Services to create transactions
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
               // Read only
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_date')
                    ->date()
                    ->sortable()
                    ->label('Date'),
                
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('reference_type')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->label('Source'),
                
                Tables\Columns\TextColumn::make('debit')
                    ->label('Debit')
                    ->state(fn (Model $record) => $record->amount > 0 ? number_format((float) $record->amount, 2) : '-')
                    ->color('danger')
                    ->alignRight(),

                Tables\Columns\TextColumn::make('credit')
                    ->label('Credit')
                    ->state(fn (Model $record) => $record->amount < 0 ? number_format((float) abs($record->amount), 2) : '-')
                    ->color('success')
                    ->alignRight(),
            ])
            ->defaultSort('transaction_date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('transaction_date')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date) => $query->whereDate('transaction_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date) => $query->whereDate('transaction_date', '<=', $date),
                            );
                    })
            ])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
