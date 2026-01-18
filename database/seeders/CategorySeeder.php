<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Nature', 'color' => '#10b981'],
            ['name' => 'Technology', 'color' => '#3b82f6'],
            ['name' => 'Education', 'color' => '#8b5cf6'],
            ['name' => 'Animals', 'color' => '#f59e0b'],
            ['name' => 'Art', 'color' => '#ec4899'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'color' => $category['color'],
            ]);
        }
    }
}