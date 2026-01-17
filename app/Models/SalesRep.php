<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRep extends Model
{
    use HasFactory;

    protected $table = 'tbm_sales';

    public $timestamps = false; // Legacy table has no timestamps

    protected $fillable = [
        'fullname',
        'email',
        'phone',
        'job_id',
        'active',
        // Add other legacy fields if needed
    ];

    protected $casts = [
        'active' => 'string', // Legacy uses "True"/"False" strings
    ];

    public function getIsActiveAttribute(): bool
    {
        return strtolower($this->active) === 'true';
    }
}
