<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    protected $fillable = [
        'help_category_id',
        'question',
        'answer',
        'in_help',
        'in_kyc',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'in_help' => 'boolean',
            'in_kyc' => 'boolean'
        ];
    }


    public function category()
    {
        return $this->belongsTo(HelpCategory::class, 'help_category_id', 'id');
    }
}
