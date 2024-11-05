<?php

namespace App\Models;

use App\Observers\UserDepositObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([UserDepositObserver::class])]
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
