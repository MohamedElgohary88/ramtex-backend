<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\PaymentMethod;
use App\Filament\Resources\PaymentResource\Pages;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Financials';

    protected static ?int $navigationSort = 2; // After Receipts

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Payment Details')
                    ->description('Payment number, supplier, and date information')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Forms\Components\TextInput::make('payment_number')
                            ->label('Payment #')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Auto-generated')
                            ->helperText('Payment number is automatically generated upon creation')
                            ->suffixIcon('heroicon-o-hashtag')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('supplier_id')
                            ->relationship('supplier', 'full_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->display_name)
                            ->searchable()
                            ->preload()
                            ->placeholder('Select Supplier (Optional for Expenses)')
                            ->helperText('Leave blank for generic expenses not tied to a specific supplier')
                            ->suffixIcon('heroicon-o-building-office')
                            ->columnSpan(['md' => 2]),

                        Forms\Components\DatePicker::make('payment_date')
                            ->label('Payment Date')
                            ->default(now())
                            ->required()
                            ->helperText('Date when payment was issued')
                            ->suffixIcon('heroicon-o-calendar')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 4])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Payment Information')
                    ->description('Amount and payment method details')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('amount')
                            ->label('Payment Amount')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->minValue(0.01)
                            ->step(0.01)
                            ->helperText('Total amount paid to supplier or for expense')
                            ->suffixIcon('heroicon-o-currency-dollar')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Select::make('payment_method')
                            ->label('Payment Method')
                            ->options(PaymentMethod::options())
                            ->required()
                            ->live()
                            ->default(PaymentMethod::CASH->value)
                            ->helperText('Select how payment was made')
                            ->suffixIcon('heroicon-o-wallet')
                            ->columnSpan(['md' => 1]),
                    ])
                    ->columns(['md' => 2])
                    ->collapsible()
                    ->columnSpanFull(),

                Forms\Components\Section::make('Check Details')
                    ->description('Check-specific information (bank, number, date)')
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
                    ->description('User who issued payment and optional notes')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->label('Issued By')
                            ->searchable()
                            ->preload()
                            ->default(auth()->id())
                            ->helperText('Admin user who created this payment record')
                            ->suffixIcon('heroicon-o-user')
                            ->columnSpan(['md' => 1]),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Any additional notes or comments about this payment...')
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
                Tables\Columns\TextColumn::make('payment_number')
                    ->label('Payment #')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('supplier.full_name') // Might be null
                    ->label('Supplier')
                    ->placeholder('Generic Expense')
                    ->formatStateUsing(fn ($record) => $record->supplier?->display_name ?? 'Generic Expense')
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

                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('payment_method')
                    ->options(PaymentMethod::options()),

                Tables\Filters\SelectFilter::make('supplier')
                    ->relationship('supplier', 'full_name')
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('payment_date', 'desc');
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
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
