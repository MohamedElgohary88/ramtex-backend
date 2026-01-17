<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Currency;

class LegacyCurrencySeeder extends Seeder
{
    public function run(): void
    {
        // Define mapping from Legacy ID/Title to Modern Code
        $legacyMap = [
            'US Dollar' => 'USD',
            'United Arab Emirates Dirham' => 'AED',
            'Lebanese Pound' => 'LBP',
            'Euro' => 'EUR',
        ];

        $legacyCurrencies = DB::table('tbs_currency')->get();

        foreach ($legacyCurrencies as $legacy) {
            $code = $legacyMap[$legacy->title] ?? strtoupper(substr($legacy->title, 0, 3));
            $isActive = strtolower($legacy->active) === 'true';
            $rate = (float) $legacy->value;

            // Determine if base currency (Assumption: USD (rate=1) is base)
            $isBase = ($code === 'USD' && $rate == 1.0);

            Currency::updateOrCreate(
                ['code' => $code],
                [
                    'name' => $legacy->title,
                    'symbol' => $legacy->sign,
                    'exchange_rate' => $rate,
                    'decimal_precision' => ($code === 'LBP') ? 0 : 2,
                    'is_base' => $isBase,
                    'is_active' => $isActive,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        
        $this->command->info('Legacy currencies migrated successfully.');
    }
}
