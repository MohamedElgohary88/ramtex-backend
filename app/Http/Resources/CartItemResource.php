<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\CartItem
 */
class CartItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $unitPrice = (float) ($this->product?->price ?? 0);
        $quantity = (int) $this->quantity;
        $subtotal = $unitPrice * $quantity;

        return [
            'id' => $this->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'subtotal' => $subtotal,
            'product' => $this->whenLoaded('product', fn () => new ProductResource($this->product)),
        ];
    }
}
