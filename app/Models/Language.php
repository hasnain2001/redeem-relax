<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'language_image',
        'name',
        'code',
        
       ];
       public function stores()
{
    return $this->hasMany(Stores::class, 'language_id');
}

}
