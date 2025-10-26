<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class Categorie extends Model
    {
        protected $table = 'categories';
        protected $primaryKey = 'category_id';

        protected $fillable = [
            'category_name',
            'description',
            'status',
            'created_by',
        ];
    }
