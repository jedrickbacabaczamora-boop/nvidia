<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusLedger extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bonus_id',
        'amount',
        'bonus_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }
}
