<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'language_id',
        'name',
        'slug',
        'top_store',
        'description',
        'url',
        'destination_url',
        'category',
        'top_store',
        'title',
        'meta_tag',
        'meta_keyword',
        'meta_description',
        'status',
        'authentication',
        'network',
        'store_image',
    ];

    
// public function language()
// {
//     return $this->belongsTo(Language::class, 'language_id');
// }
}
