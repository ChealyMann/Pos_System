<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Product extends Model
    {
        use HasFactory;

        protected $table = 'products';
        protected $primaryKey = 'product_id';
        public $timestamps = false; // Set to true if you have created_at/updated_at

        protected $fillable = [
            'barcode',
            'product_name',
            'description',
            'price',
            'min_stock',
            'category_id',
            'country_id',
            'status',
            'image',
            'created_at',
            'created_by',
            // add other columns as needed
        ];

        public function stock()
        {
            return $this->hasOne(\App\Models\Stock::class, 'product_id', 'product_id');
        }

        public function country()
        {
            return $this->belongsTo(\App\Models\Country::class, 'country_id', 'country_id');
        }

        public function category()
        {
            return $this->belongsTo(\App\Models\Categorie::class, 'category_id', 'category_id');
        }
    }
