<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\OfferStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Offer Model - Price Quotations.
 * Doesn't affect stock. Can be converted to Invoice.
 */
class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_id',
        'offer_number',
        'offer_date',
        'status',
        'total_amount',
        'vat_rate',
        'vat_amount',
        'grand_total',
        'notes',
    ];

    protected $casts = [
        'offer_date' => 'date',
        'total_amount' => 'decimal:2',
        'vat_rate' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'status' => OfferStatus::class,
    ];

    /**
     * Boot method to auto-generate offer number.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Offer $offer) {
            if (empty($offer->offer_number)) {
                $offer->offer_number = self::generateOfferNumber();
            }
            if (empty($offer->offer_date)) {
                $offer->offer_date = now();
            }
            if (empty($offer->vat_rate) && $offer->vat_rate !== 0.0) {
                 $offer->vat_rate = 11.0; // Default VAT
            }
        });
    }

    /**
     * Generate unique offer number: OFF-YYYY-XXXXX
     */
    public static function generateOfferNumber(): string
    {
        $year = date('Y');
        $prefix = "OFF-{$year}-";

        $lastOffer = self::where('offer_number', 'like', "{$prefix}%")
            ->orderBy('offer_number', 'desc')
            ->first();

        if ($lastOffer) {
            $lastNumber = (int) substr($lastOffer->offer_number, -5);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad((string) $nextNumber, 5, '0', STR_PAD_LEFT);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OfferItem::class);
    }
}
