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
            ['name' => 'Electronics'],
            ['name' => 'Fashion'],
            ['name' => 'Home & Garden'],
            ['name' => 'Books'],
            ['name' => 'Toys & Games'],
            ['name' => 'Sports & Outdoors'],
            ['name' => 'Health & Beauty'],
            ['name' => 'Automotive'],
            ['name' => 'Computers'],
            ['name' => 'Mobile Phones'],
            ['name' => 'Accessories'],
            ['name' => 'Furniture'],
            ['name' => 'Appliances'],
            ['name' => 'Jewelry & Watches'],
            ['name' => 'Baby & Kids'],
            ['name' => 'Tools & Home Improvement'],
            ['name' => 'Office Products'],
            ['name' => 'Pet Supplies'],
            ['name' => 'Food & Groceries'],
            ['name' => 'Arts & Crafts'],
            ['name' => 'Music & Instruments'],
            ['name' => 'Movies & TV'],
            ['name' => 'Video Games'],
            ['name' => 'Travel'],
            ['name' => 'Collectibles & Memorabilia'],
            ['name' => 'Apartments'],
            ['name' => 'Cars'],
            ['name' => 'Mobile Phones'],
            ['name' => 'Houses & Villas'],
        ];


        // Insert categories into the database
        Category::insert($categories);
    }
}
