<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
        protected $table = 'stocks';
    protected $primaryKey = 'stock_id';  // if different from 'id'
    public $timestamps = false;

    protected $fillable = [
        'purchase_id',
        'product_id',
        'cost',
        'qty',
        'expire_date',
    ];
}
