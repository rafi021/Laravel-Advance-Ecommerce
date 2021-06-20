<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand_list = [
            'Apple',
            'Xiaomi',
            'DELL',
            'Lenovo',
            'HP',
            'Tp-Link'
        ];

        for ($i=0; $i <count($brand_list); $i++) { 
            Brand::create([
                'brand_name_en' => $brand_list[$i],
                'brand_name_bn' => $brand_list[$i].' '.'bn',
                'brand_slug_en' => Str::slug($brand_list[$i]),
                'brand_slug_bn' => Str::slug($brand_list[$i].' '.'bn'),
            ]);
        }
    }
}
