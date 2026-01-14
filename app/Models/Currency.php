<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'exchange_rate',
        'decimal_precision',
        'is_base',
        'is_active',
        'sync_source',
        'last_synced_at',
    ];

    protected $casts = [
        'exchange_rate' => 'decimal:4',
        'decimal_precision' => 'integer',
        'is_base' => 'boolean',
        'is_active' => 'boolean',
        'last_synced_at' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeBase(Builder $query): Builder
    {
        return $query->where('is_base', true);
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value ? strtoupper($value) : null,
        );
    }
}
