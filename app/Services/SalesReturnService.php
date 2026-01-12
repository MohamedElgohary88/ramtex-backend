<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FinancialTransactionType;
use App\Enums\InvoiceStatus;
use App\Enums\StockMovementType;
use App\Models\SalesReturn;
use Illuminate\Support\Facades\DB;
use Exception;

class SalesReturnService
{
    public function __construct(
        protected StockService $stockService,
        protected TransactionService $transactionService
    ) {}

    /**
     * Post a sales return: confirm it and add stock back.
     *
     * @param SalesReturn $salesReturn
     * @return SalesReturn
     * @throws Exception
     */
    public function postReturn(SalesReturn $salesReturn): SalesReturn
    {
        if ($salesReturn->status === InvoiceStatus::POSTED) {
            throw new Exception("Sales Return is already posted.");
        }

        if ($salesReturn->items()->count() === 0) {
            throw new Exception("Cannot post a return with no items.");
        }

        return DB::transaction(function () use ($salesReturn) {
            // 1. Loop through items and add stock back (IN)
            foreach ($salesReturn->items as $item) {
                $this->stockService->adjustStock(
                    product: $item->product,
                    quantity: $item->quantity,
                    type: StockMovementType::IN->value, // Items coming back IN
                    reference: $salesReturn, // Polymorphic relation
                    notes: "Sales Return #{$salesReturn->return_number}"
                );
            }

            // 2. Mark as posted
            $salesReturn->update([
                'status' => InvoiceStatus::POSTED,
            ]);

            // Record Credit transaction (Negative amount since we owe the client)
            $this->transactionService->recordTransaction(
                client: $salesReturn->client_id,
                reference: $salesReturn,
                amount: -1 * abs((float) $salesReturn->grand_total),
                type: FinancialTransactionType::RETURN,
                description: "Sales Return #{$salesReturn->return_number}",
                date: $salesReturn->return_date->toDateString()
            );

            return $salesReturn;
        });
    }

    /**
     * Cancel a draft return.
     * Use Delete action for cancellations usually, but this is explicit.
     */
    public function cancelReturn(SalesReturn $salesReturn): SalesReturn
    {
        if ($salesReturn->status === InvoiceStatus::POSTED) {
            throw new Exception("Cannot cancel an already posted return.");
        }

        $salesReturn->update(['status' => InvoiceStatus::CANCELLED]);
        
        return $salesReturn;
    }
}
