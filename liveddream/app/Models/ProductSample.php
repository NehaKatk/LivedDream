<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSample extends Model
{
    use HasFactory;
    protected $table = 'product_samples'; // Ensure table name matches

    protected $fillable = [
        'product_id',
        'sample_image',
        'user_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
