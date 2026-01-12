<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FinancialTransactionType;
use App\Models\Receipt;
use Illuminate\Support\Facades\DB;

class ReceiptService
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function createReceipt(array $data): Receipt
    {
        return DB::transaction(function () use ($data) {
            $receipt = Receipt::create($data);

            // Record Credit transaction (Negative amount since client paid us, reducing their debt)
            // Wait - Receipt in this context usually means "Money In" (We received money from client).
            // Payment usually means "Money Out" (We paid a supplier).
            // Checking the context of this system... "Payment" module was implemented as "Outgoing Money".
            // So "Receipt" is "Incoming Money".
            
            // Logic:
            // Invoice = Client owes us (+100)
            // Receipt = Client pays us (-100) -> Balance 0.
            
            $this->transactionService->recordTransaction(
                client: $receipt->client_id,
                reference: $receipt,
                amount: -1 * abs((float) $receipt->amount),
                type: FinancialTransactionType::RECEIPT,
                description: "Receipt #{$receipt->receipt_number}",
                date: $receipt->receipt_date->toDateString()
            );

            return $receipt;
        });
    }
}
