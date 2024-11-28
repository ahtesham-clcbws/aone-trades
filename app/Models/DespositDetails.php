<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DespositDetails extends Model
{
    protected $fillable = [
        'type', // ['tether', 'upi', 'bank']
        'address', // tether address, upi address, bank account number
        'qr_code', // file
        'bank_name',
        'account_name',
        'ifsc_code',
        'micr_code',
        'branch_address',
        'type',
        'type',
    ];
}
