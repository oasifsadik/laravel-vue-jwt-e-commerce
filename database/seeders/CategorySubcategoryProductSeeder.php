<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySubcategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $data = require database_path('seeders/data/seed_data.php');

        $this->command->info('🌱 Seeding Categories...');
        $this->seedCategories($data['categories']);

        $this->command->info('🌱 Seeding Sub-Categories...');
        $this->seedSubCategories($data['sub_categories']);

        $this->command->info('🌱 Seeding Products...');
        $this->seedProducts($data['products']);

        $this->command->info('✅ All done! Seeding complete.');
    }

    // ─────────────────────────────────────────────────────────────────────────

    private function seedCategories(array $categories): void
    {
        foreach ($categories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                array_merge($categoryData, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
        $this->command->line('   → ' . count($categories) . ' categories seeded.');
    }

    private function seedSubCategories(array $subCategories): void
    {
        foreach ($subCategories as $subData) {
            $category = Category::where('slug', $subData['category_slug'])->firstOrFail();

            SubCategory::updateOrCreate(
                ['slug' => $subData['slug']],
                [
                    'category_id' => $category->id,
                    'name'        => $subData['name'],
                    'slug'        => $subData['slug'],
                    'is_active'   => true,
                    'sort_order'  => $subData['sort_order'],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]
            );
        }
        $this->command->line('   → ' . count($subCategories) . ' sub-categories seeded.');
    }

    private function seedProducts(array $products): void
    {
        foreach ($products as $productData) {
            $subCategory = SubCategory::where('slug', $productData['sub_category_slug'])->firstOrFail();

            Product::updateOrCreate(
                ['slug' => $productData['slug']],
                [
                    'sub_category_id'   => $subCategory->id,
                    'name'              => $productData['name'],
                    'slug'              => $productData['slug'],
                    'sku'               => $productData['sku'],
                    'short_description' => $productData['short_description'],
                    'description'       => $productData['description'],
                    'price'             => $productData['price'],
                    'sale_price'        => $productData['sale_price'],
                    'stock'             => $productData['stock'],
                    'thumbnail'         => $productData['thumbnail'],
                    'images'            => $productData['images'],
                    'attributes'        => $productData['attributes'],
                    'is_active'         => true,
                    'is_featured'       => $productData['is_featured'],
                    'sort_order'        => 0,
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ]
            );
        }
        $this->command->line('   → ' . count($products) . ' products seeded.');
    }
}