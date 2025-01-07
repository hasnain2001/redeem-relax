<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $fillable = [
        'language_id',
        'name',
        'clicks',
        'order',
        'description',
        'code',
        'sort',
        'destination_url',
        'top_coupons',
        'ending_date',
        'status',
        'authentication',
        'store',

    ];
}
