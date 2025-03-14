<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_slug',
        'product_price',
        'image',
        'description',
        'rating',
        'quantity',
        'status',
    ];

  
}
