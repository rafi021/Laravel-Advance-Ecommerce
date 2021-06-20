<?php

namespace Database\Seeders;

use App\Models\SubSubCategory;
use Illuminate\Database\Seeder;

class SubSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubSubCategory::factory()->count(5)->create();
    }
}
