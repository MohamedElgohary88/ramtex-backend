<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FinancialTransactionType;
use App\Models\Client;
use App\Models\FinancialTransaction;
use Illuminate\Database\Eloquent\Model;

class TransactionService
{
    /**
     * Record a financial transaction for a client.
     *
     * @param Client|int $client
     * @param Model|null $reference
     * @param float $amount Signed amount (Positive = Invoice/Debt, Negative = Payment/Credit)
     * @param FinancialTransactionType $type
     * @param string $description
     * @param string|null $date
     * @return FinancialTransaction
     */
    public function recordTransaction(
        Client|int $client,
        ?Model $reference,
        float $amount,
        FinancialTransactionType $type,
        string $description,
        ?string $date = null
    ): FinancialTransaction {
        $clientId = $client instanceof Client ? $client->id : $client;
        
        return FinancialTransaction::create([
            'client_id' => $clientId,
            'amount' => $amount,
            'type' => $type,
            'reference_type' => $reference ? get_class($reference) : null,
            'reference_id' => $reference?->id,
            'description' => $description,
            'transaction_date' => $date ?? now(),
        ]);
    }
}
