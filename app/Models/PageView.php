<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'session_id',
        'path',
        'user_agent',
        'referer',
        'ip',
        'country',
        'state',
        'city',
        'zip',
        'lat',
        'long',
        'timezone'
    ];
}
