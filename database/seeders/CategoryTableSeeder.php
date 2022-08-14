<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Category::truncate();

        $categories =  [
            [
              'name' => 'Makanan & Minuman',
              'image' => 'https://i.imgur.com/Posr0u0.png',
            ],
            [
                'name' => 'Kesehatan',
                'image' => 'https://i.imgur.com/8rtOruM.png',
              ],
          ];

          Category::insert($categories);
    }
}
