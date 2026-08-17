<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'logo_path',
        'order_num',
    ];
}
