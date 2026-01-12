<?php

declare(strict_types=1);

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum StockMovementType: string implements HasLabel, HasColor
{
    case IN = 'in';
    case OUT = 'out';
    case ADJUSTMENT = 'adjustment';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::IN => 'In (Purchase/Return)',
            self::OUT => 'Out (Sale/Damage)',
            self::ADJUSTMENT => 'Adjustment',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IN => 'success',
            self::OUT => 'danger',
            self::ADJUSTMENT => 'warning',
        };
    }
}
