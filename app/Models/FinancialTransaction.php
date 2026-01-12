<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FinancialTransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'type',
        'reference_type',
        'reference_id',
        'description',
        'transaction_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'type' => FinancialTransactionType::class,
        'transaction_date' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function reference(): MorphTo
    {
        return $this->morphTo();
    }
}
