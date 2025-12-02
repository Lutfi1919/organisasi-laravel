<?php

namespace Database\Seeders;
use App\Models\Category;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Terlambat'],
            ['name' => 'Merokok'],
            ['name' => 'Berantem'],
            ['name' => 'Tidur Saat Pembelajaran'],
            ['name' => 'Berkata Kasar'],
            ['name' => 'Makan Sambil Berdiri'],
            ['name' => 'Membawa Hand Phone'],
            ['name' => 'Membawa Plastik Kemasan'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate($category);
        }
    }
}
