<?php

namespace Database\Seeders;

use App\Models\Category;
use App\SimulatedCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (SimulatedCategory::cases() as $category) {
            Category::create([
                'category' => $category->value
            ]);
        }
    }
}
