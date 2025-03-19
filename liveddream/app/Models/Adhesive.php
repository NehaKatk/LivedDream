<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adhesive extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'company_id',
        'quantity',
        'purchase_cost',
        'selling_price',
        'user_id'
    ];
}
