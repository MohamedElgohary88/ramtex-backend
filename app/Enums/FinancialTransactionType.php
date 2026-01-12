<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FinancialTransactionType: string implements HasLabel, HasColor
{
    case INVOICE = 'invoice';
    case RECEIPT = 'receipt';
    case RETURN = 'return';
    case PAYMENT = 'payment';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::INVOICE => 'Invoice',
            self::RECEIPT => 'Receipt',
            self::RETURN => 'Return',
            self::PAYMENT => 'Payment',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::INVOICE => 'danger',
            self::RECEIPT => 'success',
            self::RETURN => 'success', // Money back or Credit Note
            self::PAYMENT => 'primary', // We pay
        };
    }
}
