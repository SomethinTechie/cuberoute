<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'price',
        'category_id',
        'keywords',
        'description'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
