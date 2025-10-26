<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'role_id'; // <-- Set your actual PK here
    protected $fillable = ['role_name', 'description', 'status'];
    public $timestamps = true; // Enable timestamps if your table has created_at and updated_at columns

}
