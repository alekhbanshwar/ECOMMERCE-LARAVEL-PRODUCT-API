<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttr extends Model
{
    use HasFactory;

    protected $table = 'product_attrs';
    protected $fillable = [
        'products_id',
        'sku',
        'attr_image',
        'mrp',
        'price',
        'qty',
        'size',
        'color',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

}
