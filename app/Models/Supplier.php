<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'email',
        'phone',
        'status',
        'address',
    ];
    public $timestamps = false;
}
