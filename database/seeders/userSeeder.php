<?php

    namespace Database\Seeders;

    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            User::create([
                'user_name'    => 'admin',
                'usercode'     => 'admin123',
                'gender'       => 'male',
                'email'        => 'admin@gmail.com',
                'phone_number' => '0123456789',
                'password'     => Hash::make('12345678'),
                'role_id'      => 1,
                'image'        => '1759736198_20221107_150347.JPG.jpg',
            ]);
        }
    }
