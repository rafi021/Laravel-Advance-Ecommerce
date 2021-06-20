<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            SubSubCategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
