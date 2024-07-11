<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'category',
        'name',
        'image',
        'slug',
        'brand',
        'model',
        'short_desc',
        'desc',
        'keywords',
        'technical_specification',
        'uses',
        'lead_time',
        'tax',
        'is_promo',
        'is_featured',
        'is_discounted',
        'is_tranding',
        'status',
    ];

    public function productAttrs()
    {
        return $this->hasMany(ProductAttr::class, 'products_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'products_id');
    }


}
