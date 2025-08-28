<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "description", "price", "stock", "featured"];

    protected $casts = [
        'featured' => 'boolean',
        'price' => 'decimal:2',
    ];
}
