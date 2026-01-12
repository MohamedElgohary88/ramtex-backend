<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Payment Model - Outgoing money to Suppliers.
 * Maps to legacy: tbm_payment
 */
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'payment_number',
        'payment_date',
        'amount',
        'payment_method',
        'check_number',
        'check_date',
        'check_bank',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_method' => PaymentMethod::class,
        'check_date' => 'date',
        'payment_date' => 'date',
    ];

    /**
     * Boot method to auto-generate payment number.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Payment $payment) {
            if (empty($payment->payment_number)) {
                $payment->payment_number = self::generatePaymentNumber();
            }
            if (empty($payment->payment_date)) {
                $payment->payment_date = now();
            }
        });
    }

    /**
     * Generate unique payment number: PMT-YYYY-XXXXX
     */
    public static function generatePaymentNumber(): string
    {
        $year = date('Y');
        $prefix = "PMT-{$year}-";

        $lastPayment = self::where('payment_number', 'like', "{$prefix}%")
            ->orderBy('payment_number', 'desc')
            ->first();

        if ($lastPayment) {
            $lastNumber = (int) substr($lastPayment->payment_number, -5);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad((string) $nextNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * The supplier who received the payment (nullable).
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * The user who issued the payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this is a check payment.
     */
    public function isCheck(): bool
    {
        return $this->payment_method === PaymentMethod::CHECK;
    }
}
