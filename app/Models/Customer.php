<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_name',
        'phone',
        'email',
        'address',
        'status',
        'credit_limit',
        'balance',
    ];
    public $timestamps = false;
}
