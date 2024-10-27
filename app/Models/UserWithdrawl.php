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
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
