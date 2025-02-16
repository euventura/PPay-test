<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'customer',
        'billing_type',
        'value',
        'due_date',
        'description',
        'days_after_due_date_to_registration_cancellation',
        'external_reference',
        'installment_count',
        'total_value',
        'postal_service',
        'discount',
        'interest',
        'fine',
        'split',
    ];

    protected $casts = [
        'discount' => 'array',
        'interest' => 'array',
        'fine' => 'array',
        'split' => 'array',
    ];
}
