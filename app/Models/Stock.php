<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';  // if different from 'id'
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'avg_cost',
        'total_qty_in_stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
