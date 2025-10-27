<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * This model represents the 'purchases' table.
     */
    class Purchase extends Model
    {
        use HasFactory;

        // The table name
        protected $table = 'purchases';

        // The primary key
        protected $primaryKey = 'purchase_id';

        /**
         * The attributes that should be cast.
         * This will automatically convert 'purchase_date' to a Carbon date object.
         *
         * @var array
         */
        protected $casts = [
            'purchase_date' => 'datetime',
        ];

        // Fields you can fill from a form
        protected $fillable = [
            'supplier_id',
            'created_by',
            'purchase_date',
            'total_amount',
            'payment_method',
            'status',
            'note',
        ];

        /**
         * Get the user (employee) who created this purchase.
         * We assume your User model uses 'user_id' as its primary key.
         */
        public function creator()
        {
            // 'created_by' is the foreign key in 'purchases' table
            // 'user_id' is the primary key in 'users' table
            return $this->belongsTo(User::class, 'created_by', 'user_id');
        }

        /**
         * Get the supplier for this purchase.
         */
        public function supplier()
        {
            // 'supplier_id' is the foreign key in 'purchases' table
            // 'supplier_id' is the primary key in 'suppliers' table
            return $this->belongsTo(Supplier::class, 'supplier_id', 'supplier_id');
        }

        /**
         * Get all the items (details) for this purchase.
         */
        public function details()
        {
            // 'purchase_id' is the foreign key in 'purchases_details' table
            // 'purchase_id' is the primary key in 'purchases' table

            // --- UPDATED ---
            // Changed from PurchaseDetail::class to PurchaseItem::class
            return $this->hasMany(Purchase_item::class, 'purchase_id', 'purchase_id');
        }
    }


