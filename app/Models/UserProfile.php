<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_code',
        'job_title',
        'department',
        'employment_type',
        'reporting_manager',
        'work_location',
        'phone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'date_of_hire',
        'salary',
        'commission_rate',
        'notes',
    ];

    protected $casts = [
        'date_of_hire' => 'date',
        'salary' => 'decimal:2',
        'commission_rate' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
