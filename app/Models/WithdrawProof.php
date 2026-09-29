<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawProof extends Model
{
    use HasFactory;

    protected $table = 'withdrawal_proofs'; // Make sure it matches your SQL

    protected $fillable = [
        'user_id',
        'comment',
        'image',
        'status',
    ];

    // Add this so we can fetch the user who submitted the proof
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
