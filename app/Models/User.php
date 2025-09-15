<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_code',
        'user_name',
        'email',
        'password',
        'role_id',
        'phone',
        'status',
        'address',
    ];
    public function role() {
    return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

}
