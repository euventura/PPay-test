<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'Payment';

    protected $fillable = [
        'customer',
        'billingType',
        'value',
        'dueDate',
        'description',
        'daysAfterDueDateToRegistrationCancellation',
        'externalReference',
        'installmentCount',
        'totalValue',
        'postalService',
        'discount',
        'interest',
        'fine',
        'split'
    ];

    protected $casts = [
        'discount' => 'array',
        'interest' => 'array',
        'fine' => 'array',
        'split' => 'array'
    ];
}
