<?php

namespace App\Observers;

use App\Models\OfferItem;

class OfferItemObserver
{
    /**
     * Handle the OfferItem "creating" event.
     */
    public function creating(OfferItem $offerItem): void
    {
        if (is_null($offerItem->total_price)) {
            $offerItem->total_price = $offerItem->quantity * $offerItem->unit_price;
        }
    }

    /**
     * Handle the OfferItem "updating" event.
     */
    public function updating(OfferItem $offerItem): void
    {
        if ($offerItem->isDirty(['quantity', 'unit_price']) && !$offerItem->isDirty('total_price')) {
             $offerItem->total_price = $offerItem->quantity * $offerItem->unit_price;
        }
    }

    /**
     * Handle the OfferItem "created" event.
     */
    public function created(OfferItem $offerItem): void
    {
        //
    }

    /**
     * Handle the OfferItem "updated" event.
     */
    public function updated(OfferItem $offerItem): void
    {
        //
    }

    /**
     * Handle the OfferItem "deleted" event.
     */
    public function deleted(OfferItem $offerItem): void
    {
        //
    }

    /**
     * Handle the OfferItem "restored" event.
     */
    public function restored(OfferItem $offerItem): void
    {
        //
    }

    /**
     * Handle the OfferItem "force deleted" event.
     */
    public function forceDeleted(OfferItem $offerItem): void
    {
        //
    }
}
