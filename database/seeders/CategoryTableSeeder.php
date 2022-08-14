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
              'image' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'Kesehatan',
                'image' => 'superadmin@gmail.com',
              ],
          ];

          Category::insert($categories);
    }
}
