<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'type',
        'is_active',
        'order_num'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_num' => 'integer'
    ];
}
