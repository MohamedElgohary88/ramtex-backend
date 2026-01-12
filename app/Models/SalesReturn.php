<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * SalesReturn Model - Customer returns.
 * Adds stock back to inventory.
 */
class SalesReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_id',
        'return_number',
        'return_date',
        'status',
        'total_amount',
        'notes',
    ];

    protected $casts = [
        'return_date' => 'date',
        'total_amount' => 'decimal:2',
        'status' => InvoiceStatus::class, // Reusing InvoiceStatus as it has DRAFT/POSTED/CANCELLED
    ];

    /**
     * Boot method to auto-generate return number.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (SalesReturn $return) {
            if (empty($return->return_number)) {
                $return->return_number = self::generateReturnNumber();
            }
            if (empty($return->return_date)) {
                $return->return_date = now();
            }
        });
    }

    /**
     * Generate unique return number: RET-YYYY-XXXXX
     */
    public static function generateReturnNumber(): string
    {
        $year = date('Y');
        $prefix = "RET-{$year}-";

        $lastReturn = self::where('return_number', 'like', "{$prefix}%")
            ->orderBy('return_number', 'desc')
            ->first();

        if ($lastReturn) {
            $lastNumber = (int) substr($lastReturn->return_number, -5);
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
        return $this->hasMany(SalesReturnItem::class);
    }
}
