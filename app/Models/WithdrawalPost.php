<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
        'image_path',
        'status',
        'reward_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
