<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'type', 'relation', 'product_category', 'zone', 
        'address', 'gst', 'city', 'pincode','user_id'
    ];
    public function godowns()
    {
        return $this->hasMany(CompanyGodownDetail::class);
    }
}
