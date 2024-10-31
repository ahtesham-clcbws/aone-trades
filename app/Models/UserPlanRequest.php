<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
