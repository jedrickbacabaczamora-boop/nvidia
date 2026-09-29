<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'get_balance_from_user_id',
        'reason',
        'perticulation',
        'amount',
        'debit',
        'credit',
        'status',
        'date',
        'step',
    ];

    public $timestamps = true; // Use this if your table has `created_at` & `updated_at`
}
