<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $attributes = [
    'images' => '[]',
];
   protected $fillable = [
    'name',
    'price',
    'description',
    'images'
    
];

protected $casts = [
    'images' => 'array',
];
}
