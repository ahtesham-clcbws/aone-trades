<?php

namespace App\Models;

use App\Observers\UserWithdrawlObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([UserWithdrawlObserver::class])]
class UserWithdrawl extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'reject_notes',
        'type',
        'address',
        'bank_name',
        'bank_branch',
        'ifsc_code'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getTransferAttribute()
    {
        return UserTransferDetail::where('user_id', $this->user_id)->where('type', $this->type)->first();
    }
}
