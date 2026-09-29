<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyLedger extends Model
{
    use HasFactory;
    public function draw()
    {
        return $this->belongsTo(Drow::class, 'draw_id', 'id');
    }
}
