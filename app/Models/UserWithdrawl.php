<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWithdrawl extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'user_comments',
        'status',
        'reject_notes',
        'type',
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
