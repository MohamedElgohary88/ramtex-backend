<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\PaymentMethod;
use App\Filament\Resources\ReceiptResource\Pages;
use App\Models\Receipt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReceiptResource extends Resource
{
    protected static ?string $model = Receipt::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Financials';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Receipt Details')
                    ->description('Receipt number, client, and date received')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('receipt_number')
                            ->label('Receipt #')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto-generated')
                            ->helperText('Receipt number is automatically generated upon creation')
                            ->suffixIcon('heroicon-o-hashtag')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('client_id')
                            ->relationship('client', 'full_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->helperText('Client who made the payment')
                            ->suffixIcon('heroicon-o-user')
                            ->columnSpan(['md' => 2]),

                        Forms\Components\DateTimePicker::make('received_at')
                            ->label('Received Date & Time')
                            ->default(now())
                            ->required()
                            ->helperText('Date and time when payment was received')
                            ->suffixIcon('heroicon-o-calendar')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 4])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Payment Information')
                    ->description('Amount received and payment method')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('Amount Received')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0.01)
                            ->step(0.01)
                            ->helperText('Total amount received from client')
                            ->suffixIcon('heroicon-o-currency-dollar')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options(PaymentMethod::options())
                            ->required()
                            ->live()
                            ->default(PaymentMethod::CASH->value)
                            ->helperText('How the payment was received')
                            ->suffixIcon('heroicon-o-wallet')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Check Details')
                    ->description('Check-specific information')
                    ->icon('heroicon-o-document-check')
                    ->schema([
                        Forms\Components\TextInput::make('check_number')
                            ->label('Check Number')
                            ->maxLength(255)
                            ->helperText('Check serial number')
                            ->suffixIcon('heroicon-o-hashtag')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\TextInput::make('check_bank')
                            ->label('Bank Name')
                            ->maxLength(255)
                            ->helperText('Bank that issued the check')
                            ->suffixIcon('heroicon-o-building-library')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\DatePicker::make('check_date')
                            ->label('Check Date')
                            ->helperText('Date written on the check')
                            ->suffixIcon('heroicon-o-calendar')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 3])
                    ->collapsible()
                    ->columnSpanFull()
                    ->visible(fn (Get $get): bool => $get('payment_method') === PaymentMethod::CHECK->value),

                Forms\Components\Section::make('Additional Information')
                    ->description('User who received payment and optional notes')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Received By')
                            ->searchable()
                            ->preload()
                            ->default(auth()->id())
                            ->helperText('Admin user who recorded this receipt')
                            ->suffixIcon('heroicon-o-user')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Any additional notes or comments about this receipt...')
                            ->helperText('Optional: Add internal notes for reference')
                            ->rows(3)
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])
                    ->columns(['md' => 1])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('receipt_number')
                    ->label('Receipt #')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('client.full_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('USD')
                    ->sortable()
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->badge()
                    ->formatStateUsing(fn (PaymentMethod $state): string => $state->label())
                    ->color(fn (PaymentMethod $state): string => match ($state) {
                        PaymentMethod::CASH => 'success',
                        PaymentMethod::CHECK => 'warning',
                        PaymentMethod::BANK_TRANSFER => 'info',
                        PaymentMethod::CREDIT_CARD => 'primary',
                    }),

                Tables\Columns\TextColumn::make('check_number')
                    ->label('Check #')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Received By')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('received_at')
                    ->label('Received')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options(PaymentMethod::options()),

                Tables\Filters\SelectFilter::make('client')
                    ->relationship('client', 'full_name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('received_at')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('received_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('received_at', '<=', $date),
                            );
                    }),

                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('received_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReceipts::route('/'),
            'create' => Pages\CreateReceipt::route('/create'),
            'edit' => Pages\EditReceipt::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
