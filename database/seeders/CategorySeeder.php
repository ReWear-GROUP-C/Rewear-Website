<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['category_name' => 'Tops / T-Shirts',     'co2_constant' => 6.50],
            ['category_name' => 'Bottoms / Pants',     'co2_constant' => 11.50],
            ['category_name' => 'Outerwear / Jackets', 'co2_constant' => 18.00],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
