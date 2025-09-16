<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock_in extends Model
{
    protected $table = 'tblstock_ins';
    protected $primaryKey = 'stock_in_id';  // if different from 'id'
    public $timestamps = false;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'cost',
        'qty',
        'expire_date',
        'user_id',
        'add_date',
        'in_stock',
    ];
}
