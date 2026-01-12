<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FinancialTransactionType;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentService
{
    public function __construct(
        protected TransactionService $transactionService
    ) {}

    public function createPayment(array $data): Payment
    {
        return DB::transaction(function () use ($data) {
            $payment = Payment::create($data);

            // Record Credit transaction (Negative amount since client paid us, reducing their debt)
            $this->transactionService->recordTransaction(
                client: $payment->client_id,
                reference: $payment,
                amount: -1 * abs((float) $payment->amount),
                type: FinancialTransactionType::PAYMENT,
                description: "Payment #{$payment->payment_number}",
                date: $payment->payment_date->toDateString()
            );

            return $payment;
        });
    }
}
