<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FinancialTransactionType;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class InvoiceService
{
    public function __construct(
        protected StockService $stockService,
        protected TransactionService $transactionService
    ) {}

    /**
     * Create a new invoice with items.
     *
     * @param Client $client
     * @param array $items Array of ['product_id', 'quantity', 'unit_price']
     * @param string|null $invoiceNumber
     * @param string|null $invoiceDate
     * @param float $vatRate VAT percentage (e.g., 11.00)
     * @param string|null $notes
     * @param User|null $user
     * @return Invoice
     */
    public function createInvoice(
        Client $client,
        array $items,
        ?string $invoiceNumber = null,
        ?string $invoiceDate = null,
        float $vatRate = 0,
        ?string $notes = null,
        ?User $user = null
    ): Invoice {
        if (empty($items)) {
            throw new InvalidArgumentException("Invoice must have at least one item.");
        }

        return DB::transaction(function () use ($client, $items, $invoiceNumber, $invoiceDate, $vatRate, $notes, $user) {
            // Calculate totals
            $totalAmount = 0;
            foreach ($items as $item) {
                $lineTotal = $item['quantity'] * $item['unit_price'];
                $totalAmount += $lineTotal;
            }

            $vatAmount = $totalAmount * ($vatRate / 100);
            $grandTotal = $totalAmount + $vatAmount;

            // Create Invoice
            $invoice = Invoice::create([
                'client_id' => $client->id,
                'user_id' => $user?->id,
                'invoice_number' => $invoiceNumber ?? Invoice::generateInvoiceNumber(),
                'invoice_date' => $invoiceDate ?? now()->toDateString(),
                'status' => 'draft',
                'total_amount' => $totalAmount,
                'vat_rate' => $vatRate,
                'vat_amount' => $vatAmount,
                'grand_total' => $grandTotal,
                'notes' => $notes,
            ]);

            // Create Invoice Items
            foreach ($items as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'total_line_price' => $item['quantity'] * $item['unit_price'],
                ]);
            }

            return $invoice->load('items');
        });
    }

    /**
     * Post an invoice - deducts stock and marks as posted.
     * This is THE critical transaction for inventory.
     *
     * @param Invoice $invoice
     * @param User|null $user
     * @return Invoice
     * @throws \Exception
     */
    public function postInvoice(Invoice $invoice, ?User $user = null): Invoice
    {
        if ($invoice->isPosted()) {
            throw new \Exception("Invoice #{$invoice->invoice_number} is already posted.");
        }

        if ($invoice->status === 'cancelled') {
            throw new \Exception("Cannot post a cancelled invoice.");
        }

        return DB::transaction(function () use ($invoice, $user) {
            // 1. Reload fresh items from DB to ensure totals are correct
            $invoice->fresh(['items.product']);
            $invoice->load(['items', 'client']);

            // 2. Recalculate Totals (Safety Step)
            $subtotal = $invoice->items->sum('total_line_price');
            $vatRate = (float) $invoice->vat_rate;
            $vatAmount = $subtotal * ($vatRate / 100);
            $grandTotal = $subtotal + $vatAmount;

            // 3. Update Invoice with Correct Totals
            $invoice->update([
                'total_amount' => $subtotal,
                'vat_amount' => $vatAmount,
                'grand_total' => $grandTotal,
                'status' => 'posted',
                'posted_at' => now(),
            ]);

            // 4. Deduct stock for each item
            foreach ($invoice->items as $item) {
                // Determine product (might be unrelated if relation not loaded properly, but we loaded it)
                $product = $item->product ?? \App\Models\Product::find($item->product_id);
                
                if ($product) {
                    $this->stockService->adjustStock(
                        product: $product,
                        quantity: $item->quantity,
                        type: 'out',
                        user: $user,
                        notes: "Invoice #{$invoice->invoice_number}",
                        reference: $invoice
                    );
                }
            }

            // 5. Record Financial Transaction (Debt)
            $this->transactionService->recordTransaction(
                client: $invoice->client,
                reference: $invoice,
                amount: (float) $invoice->grand_total,
                type: FinancialTransactionType::INVOICE,
                description: "Invoice #{$invoice->invoice_number}",
                date: $invoice->invoice_date->toDateString()
            );

            return $invoice->fresh();
        });
    }

    /**
     * Cancel an invoice. Does NOT restore stock (that's a Return).
     *
     * @param Invoice $invoice
     * @return Invoice
     * @throws \Exception
     */
    public function cancelInvoice(Invoice $invoice): Invoice
    {
        if ($invoice->isPosted()) {
            throw new \Exception("Cannot cancel a posted invoice. Create a Return instead.");
        }

        $invoice->update(['status' => 'cancelled']);

        return $invoice->fresh();
    }

    /**
     * Recalculate invoice totals based on items.
     *
     * @param Invoice $invoice
     * @return Invoice
     */
    public function recalculateTotals(Invoice $invoice): Invoice
    {
        $totalAmount = $invoice->items()->sum(DB::raw('quantity * unit_price'));
        $vatAmount = $totalAmount * ($invoice->vat_rate / 100);
        $grandTotal = $totalAmount + $vatAmount;

        $invoice->update([
            'total_amount' => $totalAmount,
            'vat_amount' => $vatAmount,
            'grand_total' => $grandTotal,
        ]);

        return $invoice->fresh();
    }
}
