<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $table = 'tblproducts';      // your table name
    protected $primaryKey = 'product_id';  // the actual PK column
    public $timestamps = false;

}
