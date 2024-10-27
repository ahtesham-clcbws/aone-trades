<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'deposit_receipt',
        'status',
        'reject_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
