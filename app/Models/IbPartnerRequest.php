<?php

namespace App\Models;

use App\Observers\IbPartnerRequestObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([IbPartnerRequestObserver::class])]
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
