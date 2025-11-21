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
            ['name' => 'Çorbalar', 'slug' => 'corbalar', 'order' => 1],
            ['name' => 'Ana Yemekler', 'slug' => 'ana-yemekler', 'order' => 2],
            ['name' => 'Salatalar', 'slug' => 'salatalar', 'order' => 3],
            ['name' => 'Pizzalar', 'slug' => 'pizzalar', 'order' => 4],
            ['name' => 'Burgerler', 'slug' => 'burgerler', 'order' => 5],
            ['name' => 'Makarnalar', 'slug' => 'makarnalar', 'order' => 6],
            ['name' => 'Tatlılar', 'slug' => 'tatlilar', 'order' => 7],
            ['name' => 'İçecekler', 'slug' => 'icecekler', 'order' => 8],
            ['name' => 'Diğer', 'slug' => 'diger', 'order' => 999],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
