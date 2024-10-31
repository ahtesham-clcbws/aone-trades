<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IbPartnerRequest extends Model
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
