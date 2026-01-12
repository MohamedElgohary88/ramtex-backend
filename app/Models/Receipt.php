<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Receipt Model - Incoming payments from clients.
 * Maps to legacy: tbm_receipt
 * 
 * A receipt records money received from a client,
 * which can later be allocated against invoices.
 */
class Receipt extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'user_id',
        'receipt_number',
        'amount',
        'payment_method',
        'check_number',
        'check_bank',
        'check_date',
        'notes',
        'received_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_method' => PaymentMethod::class,
        'check_date' => 'date',
        'received_at' => 'datetime',
    ];

    /**
     * Boot method to auto-generate receipt number.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Receipt $receipt) {
            if (empty($receipt->receipt_number)) {
                $receipt->receipt_number = self::generateReceiptNumber();
            }
            if (empty($receipt->received_at)) {
                $receipt->received_at = now();
            }
        });
    }

    /**
     * Generate unique receipt number: RCP-YYYY-XXXXX
     */
    public static function generateReceiptNumber(): string
    {
        $year = date('Y');
        $prefix = "RCP-{$year}-";

        $lastReceipt = self::where('receipt_number', 'like', "{$prefix}%")
            ->orderBy('receipt_number', 'desc')
            ->first();

        if ($lastReceipt) {
            $lastNumber = (int) substr($lastReceipt->receipt_number, -5);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return $prefix . str_pad((string) $nextNumber, 5, '0', STR_PAD_LEFT);
    }

    /**
     * The client who made the payment.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The user (sales rep) who received the payment.
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
