<?php

namespace App\Models;

use App\Observers\UserKycObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([UserKycObserver::class])]
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
