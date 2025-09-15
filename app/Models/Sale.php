<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Sale_item;

class Sale extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $fillable = [
        'customer_id',
        'sale_date',
        'total_amount',
        'discount',
        'paid_amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    public function saleItems()
    {
        return $this->hasMany(Sale_item::class, 'sale_id', 'sale_id');
    }
}
