<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id', 'category_id', 'name', 'product_code',
         'gst', 'warranty_duration', 'warranty_type', 'app_area',
        'adhesive_id', 'labor_charge', 'estimate_delivery_duration','estimate_delivery_type', 'image', 'user_id'
    ];
        // Relationship with ProductSize
        public function sizes()
        {
            return $this->hasMany(ProductSize::class, 'product_id');
        }
        // Relationship with ProductImage
        public function images()
        {
            return $this->hasMany(ProductImage::class, 'product_id');
        }
        public function samples()
        {
            return $this->hasMany(ProductSample::class, 'product_id');
        }
        public function company()
        {
            return $this->belongsTo(Company::class, 'company_id');
        }
    
        // A product belongs to a category
        public function category()
        {
            return $this->belongsTo(Category::class, 'category_id');
        }
        public function adhesive()
        {
            return $this->belongsTo(Adhesive::class, 'adhesive_id');
        }
}