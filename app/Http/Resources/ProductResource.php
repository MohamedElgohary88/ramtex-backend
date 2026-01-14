<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\PriceListItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Product
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $client = $request->user('client-api');
        $displayPrice = $this->price;

        if ($client && $client->price_list_id) {
            $customPriceItem = PriceListItem::where('price_list_id', $client->price_list_id)
                ->where('product_id', $this->id)
                ->first();
            
            if ($customPriceItem) {
                $displayPrice = $customPriceItem->price;
            }
        }
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'item_code' => $this->item_code,
            'description' => $this->description,
            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],
            'brand' => [
                'id' => $this->brand?->id,
                'name' => $this->brand?->name,
                'slug' => $this->brand?->slug,
                'logo_url' => $this->brand?->image ? asset('storage/' . $this->brand->image) : null,
            ],
            'price' => (float) $displayPrice,
            'image_url' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'stock_available' => $this->stock_on_hand,
            'in_stock' => $this->stock_on_hand > 0,
            'is_favorite' => $client ? $client->favorites()->where('product_id', $this->id)->exists() : false,
        ];
    }
}
