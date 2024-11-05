<?php

namespace App\Models;

use App\Observers\TradingAccountRequestObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([TradingAccountRequestObserver::class])]
class TradingAccountRequest extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'reject_notes'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
