<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\InvoiceStatus;
use App\Enums\OfferStatus;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use Exception;

class OfferService
{
    /**
     * Convert an Offer to a Draft Invoice.
     *
     * @param Offer $offer
     * @return Invoice
     * @throws Exception
     */
    public function convertOfferToInvoice(Offer $offer): Invoice
    {
        if ($offer->status === OfferStatus::CONVERTED) {
            throw new Exception("This offer has already been converted to an invoice.");
        }

        return DB::transaction(function () use ($offer) {
            // 1. Create Invoice (Draft)
            // Note: InvoiceService would typically handle Invoice creation, but here we are replicating data.
            // We'll let the Invoice model boot method handle the number generation.
            
            $invoice = Invoice::create([
                'client_id' => $offer->client_id,
                'user_id' => auth()->id() ?? $offer->user_id,
                'invoice_date' => now(), // New date for invoice
                'status' => InvoiceStatus::DRAFT,
                'total_amount' => $offer->total_amount,
                'vat_rate' => $offer->vat_rate,
                'vat_amount' => $offer->vat_amount,
                'grand_total' => $offer->grand_total,
                'notes' => "Converted from Offer #{$offer->offer_number}. \n" . $offer->notes,
            ]);

            // 2. Replicate Items
            foreach ($offer->items as $item) {
                // Check current price vs offer price? 
                // Requirement implies replication, so we keep offer price usually.
                
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_line_price' => $item->total_price,
                ]);
            }

            // 3. Update Offer Status
            $offer->update(['status' => OfferStatus::CONVERTED]);

            return $invoice;
        });
    }
}
