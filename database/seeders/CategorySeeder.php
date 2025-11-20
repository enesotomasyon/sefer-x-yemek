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
        $categories = [
            ['name' => 'Çorbalar', 'order' => 1],
            ['name' => 'Ana Yemekler', 'order' => 2],
            ['name' => 'Salatalar', 'order' => 3],
            ['name' => 'Pizzalar', 'order' => 4],
            ['name' => 'Burgerler', 'order' => 5],
            ['name' => 'Makarnalar', 'order' => 6],
            ['name' => 'Tatlılar', 'order' => 7],
            ['name' => 'İçecekler', 'order' => 8],
            ['name' => 'Diğer', 'order' => 999],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
