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
            'usercode',
            'user_name',
            'gender',
            'email',
            'password',
            'role_id',
            'phone_number',
            'status',
            'address',
            'image',

        ];
        public function role() {
            return $this->belongsTo(Role::class, 'role_id', 'role_id');
        }

    }
