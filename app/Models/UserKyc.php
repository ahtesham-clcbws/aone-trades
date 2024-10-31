<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    protected $fillable = [
        'user_id',
        'pancard_file',
        'address_proof_file',
        'address_proof_file_back',
        'status',
        'reject_notes'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
