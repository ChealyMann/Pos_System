<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * This model represents the 'purchases_details' table.
     * We are naming it PurchaseItem as you requested.
     */
    class Purchase_item extends Model
    {
        use HasFactory;

        protected $table = 'purchases_details';
        protected $primaryKey = 'purchase_detail_id';

        protected $casts = [
            'expiry_date' => 'datetime',
        ];

        protected $fillable = [
            'purchase_id',
            'product_id',
            'qty',
            'unit_cost',
            'expiry_date',
            'total_cost',
        ];

        /**
         * Get the product for this purchase item.
         */
        public function product()
        {
            return $this->belongsTo(Product::class, 'product_id', 'product_id');
        }

        /**
         * Get the main purchase order this item belongs to.
         */
        public function purchase()
        {
            return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
        }
    }
