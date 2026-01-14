<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Currency;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class CurrencyService
{
    public function store(array $data): Currency
    {
        return DB::transaction(function () use ($data) {
            $currency = Currency::create($this->preparePayload($data));
            $this->ensureSingleBase($currency);

            return $currency->refresh();
        });
    }

    public function update(Currency $currency, array $data): Currency
    {
        return DB::transaction(function () use ($currency, $data) {
            $currency->update($this->preparePayload($data));
            $this->ensureSingleBase($currency);

            return $currency->refresh();
        });
    }

    public function convert(string|int|float $amount, Currency $from, Currency $to, int $scale = 4): string
    {
        if ($amount === '' || $amount === null) {
            throw new InvalidArgumentException('Amount cannot be empty.');
        }

        if ($from->exchange_rate <= 0 || $to->exchange_rate <= 0) {
            throw new InvalidArgumentException('Exchange rates must be positive values.');
        }

        $decimalAmount = BigDecimal::of((string) $amount);
        $baseValue = $decimalAmount->multipliedBy(BigDecimal::of($from->exchange_rate));

        if ($to->is_base) {
            return $baseValue->toScale($to->decimal_precision, RoundingMode::HALF_UP);
        }

        $result = $baseValue->dividedBy(
            divisor: BigDecimal::of($to->exchange_rate),
            scale: max($scale, $to->decimal_precision),
            roundingMode: RoundingMode::HALF_UP,
        );

        return $result->toScale($to->decimal_precision, RoundingMode::HALF_UP);
    }

    protected function preparePayload(array $data): array
    {
        if (empty($data['code'])) {
            throw new InvalidArgumentException('Currency code is required.');
        }

        if (isset($data['exchange_rate']) && (float) $data['exchange_rate'] <= 0) {
            throw new InvalidArgumentException('Exchange rate must be greater than zero.');
        }

        $data['code'] = strtoupper($data['code']);
        $data['symbol'] = $data['symbol'] ?? $data['code'];

        $precision = (int) ($data['decimal_precision'] ?? 2);
        $data['decimal_precision'] = max(0, min($precision, 4));

        $data['is_active'] = (bool) ($data['is_active'] ?? true);
        $data['is_base'] = (bool) ($data['is_base'] ?? false);

        return $data;
    }

    protected function ensureSingleBase(Currency $currency): void
    {
        if ($currency->is_base) {
            Currency::query()
                ->whereKeyNot($currency->getKey())
                ->update(['is_base' => false]);
        } elseif (! Currency::query()->where('is_base', true)->exists()) {
            $currency->forceFill(['is_base' => true])->save();
        }
    }
}
