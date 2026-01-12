<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'invoice_number',
        'status',
        'invoice_date',
        'total_amount',
        'vat_rate',
        'vat_amount',
        'grand_total',
        'notes',
        'posted_at',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'posted_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'vat_rate' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

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
        return $this->hasMany(InvoiceItem::class);
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isPosted(): bool
    {
        return $this->status === 'posted';
    }

    /**
     * Generate the next invoice number.
     */
    public static function generateInvoiceNumber(): string
    {
        $year = now()->format('Y');
        $lastInvoice = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastInvoice 
            ? (int) substr($lastInvoice->invoice_number, -5) + 1 
            : 1;

        return "INV-{$year}-" . str_pad((string) $sequence, 5, '0', STR_PAD_LEFT);
    }
}
