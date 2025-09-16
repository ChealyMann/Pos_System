បង្កើត Model, Table
php artisan make:model Product -m

បង្កើត Model, Table, Controller
php artisan make:model Product -mc

1. បង្កើត Model
php artisan make:model Product

2. បង្កើត Migration
php artisan make:migration create_products_table

បន្ទាប់មក
php artisan migrate
php artisan migrate --path=/database/migrations/2025_08_08_123456_create_stock_table.php


3. បង្កើត Controller
php artisan make:controller ProductController
or.បង្កើត Controller ដែលមាន​ resources
php artisan make:controller ProductController -r

របៀបប្រើ Seeder ដើម្បីបញ្ចូលទិន្នន័យ (insert data) ទៅក្នុង Model Product នៅក្នុង Laravel:
ជំហាន1 : បង្កើត Seeder
php artisan make:seeder ProductSeeder

នឹងបង្កើត database/seeders/ProductSeeder.php
ជំហាន 2: សរសេរ logic ក្នុង ProductSeeder.php

$products = [
            ["product_name"=>"Coca", "price" => "1000", "qty" => "5"],
            ["product_name"=>"Fanta", "price" => "500", "qty" => "10"],
            ["product_name"=>"Sting", "price" => "150", "qty" => "15"],
        ];

        foreach ($products as  $product) {
            Product::create($product);
        }

ជំហាន 3: ចុះបញ្ជី Seeder ក្នុង DatabaseSeeder.php

    $this->call([
            ProductSeeder::class
        ]);

ជំហាន 4: Run Seeder
php artisan db:seed

or ឬ Run តែ ProductSeeder ប៉ុណ្ណោះ៖

php artisan db:seed --class=ProductSeeder



Route::controller(Usercontroller::class)->group(function () {
    Route::get('/user', 'index')->name('user.index');
});


git fetch              # update 'master' from remote
git tag base master    # mark our base point
git rebase -i master   # rewrite some commits
git push --force-with-lease=master:base master:master

git branch -M master


git init
git add .
git commit -m "First commit"

git remote add origin https://github.com/rathana4530/POS_System_SA.git

git push -u origin master
git push -u origin Rathana

git pull origin Rathana
