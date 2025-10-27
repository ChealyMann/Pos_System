<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class   Stock_in extends Model
{
    protected $table = 'stock_ins';
    protected $primaryKey = 'stock_in_id';
    public $timestamps = true;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'created_by',
        'qty',
        'cost_per_item',
        'expire_date',
        'qty_in_stock',
        'stock_in_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
