<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CateigorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = 
        [
            'cat test one', 
            'cat test two', 
            'cat test three'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'ar' => ['name' => $category],
                'en' => ['name' => $category],
            ]);
        }
    }
}
