<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'image',
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];


    // Implement business logic methods
    public function calculateDiscountedPrice($discountPercentage)
    {
        return $this->price - ($this->price * $discountPercentage / 100);
    }

    public function isInStock()
    {
        return $this->stock > 0;
    }
}
