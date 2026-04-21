<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seller = User::where('email', 'seller@rewear.com')->first();
        
        $items = [
            [
                'item_name'   => 'Midnight Velvet Evening Jacket',
                'description' => 'A stunning deep navy velvet jacker worn by Someone in SI47INT.',
                'size'        => 'L',
                'condition'   => 'like_new',
                'price'       => 1200000,
                'photo_path'  => [], //blm ada gambarnya
                'status'      => 'available',
                'users_id'    => $seller->id,
                'category_id' => 3,
            ],
            [
                'item_name'   => 'Retro 90s Oversized T-Shirt',
                'description' => 'Genuine Knitted Denim Leather T-Shirt',
                'size'        => 'L',
                'condition'   => 'good',
                'price'       => 50000,
                'photo_path'  => [],
                'status'      => 'available',
                'users_id'    => $seller->id,
                'category_id' => 1,
            ],
            [
                'item_name'   => 'Urban Explorer Cargo Pants',
                'description' => 'Multi-pocket canvas pants in olive green. Fit for PPL Class',
                'size'        => '32',
                'condition'   => 'new_with_tags',
                'price'       => 520000,
                'photo_path'  => [],
                'status'      => 'available',
                'users_id'    => $seller->id,
                'category_id' => 2,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
