<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationOptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variation_id',
        'variationName',
        'sku',
        'price',
    ];

    public function productVariant() {
        return $this->belongsTo(ProductVariant::class, 'product_variation_id');
    }
}
