<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTransferDetail extends Model
{
    protected $fillable = [
        'user_id',
        'type', // ['Bank', 'UPI', 'USDT']
        'address',
        'bank_name',
        'bank_branch',
        'ifsc_code',
        'isActive'
    ];
}
