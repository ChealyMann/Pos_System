<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'email',
        'phone_number',
        'gender',
        'image',
        'created_by',
        'address',
        'status',
    ];

    public $timestamps = false; // Let Laravel manage created_at & updated_at

}
