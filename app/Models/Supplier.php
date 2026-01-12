<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Supplier Model - Vendors/Suppliers for purchasing inventory.
 * Maps to legacy: tbm_supplier
 */
class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_name',
        'full_name',
        'email',
        'phone',
        'financial_number',
        'address_line_1',
        'address_line_2',
        'city',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope: Active suppliers only.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get full display name (company or individual).
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->company_name ?: $this->full_name;
    }
}
