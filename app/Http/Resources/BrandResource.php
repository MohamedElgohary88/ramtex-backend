<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Brand
 */
class BrandResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'logo_url' => $this->image ? asset('storage/' . $this->image) : null,
            'products_count' => $this->when(isset($this->products_count), (int) $this->products_count, function () {
                return $this->products()->count();
            }),
        ];
    }
}
