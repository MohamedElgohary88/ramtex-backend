<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Invoice
 */
class InvoiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_number' => $this->invoice_number,
            'status' => $this->status,
            'invoice_date' => $this->invoice_date->toIso8601String(),
            'items' => InvoiceItemResource::collection($this->whenLoaded('items')),
            'total_amount' => (float) $this->total_amount,
            'vat_rate' => (float) $this->vat_rate,
            'vat_amount' => (float) $this->vat_amount,
            'grand_total' => (float) $this->grand_total,
            'notes' => $this->notes,
            'posted_at' => $this->posted_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
