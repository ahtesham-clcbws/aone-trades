<?php

namespace App\Models;

use App\Observers\UserPlanRequestObserver;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\ObservedBy;
#[ObservedBy([UserPlanRequestObserver::class])]
class UserPlanRequest extends Model
{

    protected $fillable = [
        'user_id',
        'current_package',
        'package',
        'status',
        'reject_notes'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
