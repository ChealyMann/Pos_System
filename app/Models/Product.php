<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
     use HasFactory;
    protected $table='products';
    protected $primaryKey='product_id';
    protected $fillable = [
        'product_id',
        'product_name',
        'barcode',
        'category_id',
        'unit_id',
        'cost_price',
        'wholesale_price',
        'status',
    ];
    public $timestamps = false;
}
