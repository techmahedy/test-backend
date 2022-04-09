<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_month',
        'bill_year',
        'amount',
        'status',
        'billable_id',
        'billable_type'
    ];
}
