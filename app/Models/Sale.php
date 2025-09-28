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
        'sale_by',
        'sale_date',
        'total_amount',
        'paid_amount',
        'status',
    ];

    public function saleItems()
    {
        return $this->hasMany(Sale_item::class, 'sale_id', 'sale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sale_by', 'user_id');
    }
}
