<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Payment methods supported by the system.
 * Used for Receipts (incoming) and Payments (outgoing).
 */
enum PaymentMethod: string
{
    case CASH = 'cash';
    case CHECK = 'check';
    case BANK_TRANSFER = 'bank_transfer';
    case CREDIT_CARD = 'credit_card';

    /**
     * Human-readable label for display.
     */
    public function label(): string
    {
        return match ($this) {
            self::CASH => 'Cash',
            self::CHECK => 'Check',
            self::BANK_TRANSFER => 'Bank Transfer',
            self::CREDIT_CARD => 'Credit Card',
        };
    }

    /**
     * Get all methods as options array for forms.
     */
    public static function options(): array
    {
        return collect(self::cases())->mapWithKeys(
            fn (self $case) => [$case->value => $case->label()]
        )->toArray();
    }
}
