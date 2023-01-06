<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_id'
    ];

    protected $with = [
        'product',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
