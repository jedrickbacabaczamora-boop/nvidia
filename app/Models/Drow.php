<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Drow extends Model
{
    use HasFactory;

    public function ledger()
    {
        return $this->hasOne(LuckyLedger::class, 'draw_id', 'id')
            ->where('user_id', Auth::id());
    }
}
