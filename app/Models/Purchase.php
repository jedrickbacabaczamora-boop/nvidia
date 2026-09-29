<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
{
    return $this->belongsTo(\App\Models\Package::class);
}
public function userLedgers()
{
    return $this->hasMany(UserLedger::class, 'purchase_id');
}
}
