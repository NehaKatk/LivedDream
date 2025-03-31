<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $table = 'product_size';
    protected $fillable = ['product_id', 'key', 'value', 'unit', 'user_id'];
  

    // Relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
