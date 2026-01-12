<?php

namespace App\Observers;

use App\Models\InvoiceItem;

class InvoiceItemObserver
{
    /**
     * Handle the InvoiceItem "creating" event.
     */
    public function creating(InvoiceItem $invoiceItem): void
    {
        if (is_null($invoiceItem->total_line_price)) {
            $invoiceItem->total_line_price = $invoiceItem->quantity * $invoiceItem->unit_price;
        }
    }

    /**
     * Handle the InvoiceItem "updating" event.
     */
    public function updating(InvoiceItem $invoiceItem): void
    {
        // Ideally should recalculate on update too if quantity/price changed but total didn't
        if ($invoiceItem->isDirty(['quantity', 'unit_price']) && !$invoiceItem->isDirty('total_line_price')) {
             $invoiceItem->total_line_price = $invoiceItem->quantity * $invoiceItem->unit_price;
        }
    }

    /**
     * Handle the InvoiceItem "created" event.
     */
    public function created(InvoiceItem $invoiceItem): void
    {
        //
    }

    /**
     * Handle the InvoiceItem "updated" event.
     */
    public function updated(InvoiceItem $invoiceItem): void
    {
        //
    }

    /**
     * Handle the InvoiceItem "deleted" event.
     */
    public function deleted(InvoiceItem $invoiceItem): void
    {
        //
    }

    /**
     * Handle the InvoiceItem "restored" event.
     */
    public function restored(InvoiceItem $invoiceItem): void
    {
        //
    }

    /**
     * Handle the InvoiceItem "force deleted" event.
     */
    public function forceDeleted(InvoiceItem $invoiceItem): void
    {
        //
    }
}
