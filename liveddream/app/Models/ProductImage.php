<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'pdf_name',
        'product_code',
        'product_color',
        'product_image',
        'purchase_cost',
        'selling_price',
        'discount_price',
        'stock_available',
        'sample_status',
       'user_id'
    ];
}
