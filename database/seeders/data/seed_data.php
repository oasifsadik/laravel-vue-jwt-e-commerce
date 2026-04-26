<?php

// database/seeders/data/seed_data.php
// ─── Centralized dummy data for all seeders ─────────────────────────────────

return [

    'categories' => [
        [
            'name'        => 'Electronics',
            'slug'        => 'electronics',
            'description' => 'Gadgets, devices, and all things electronic.',
            'image'       => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400',
            'is_active'   => true,
            'sort_order'  => 1,
        ],
        [
            'name'        => 'Fashion',
            'slug'        => 'fashion',
            'description' => 'Clothing, footwear, and accessories for everyone.',
            'image'       => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400',
            'is_active'   => true,
            'sort_order'  => 2,
        ],
        [
            'name'        => 'Home & Living',
            'slug'        => 'home-living',
            'description' => 'Furniture, decor, and everything for your home.',
            'image'       => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400',
            'is_active'   => true,
            'sort_order'  => 3,
        ],
        [
            'name'        => 'Sports & Outdoors',
            'slug'        => 'sports-outdoors',
            'description' => 'Equipment and gear for an active lifestyle.',
            'image'       => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?w=400',
            'is_active'   => true,
            'sort_order'  => 4,
        ],
    ],

    'sub_categories' => [
        // Electronics
        ['category_slug' => 'electronics', 'name' => 'Smartphones',  'slug' => 'smartphones',   'sort_order' => 1],
        ['category_slug' => 'electronics', 'name' => 'Laptops',       'slug' => 'laptops',        'sort_order' => 2],
        ['category_slug' => 'electronics', 'name' => 'Audio',         'slug' => 'audio',          'sort_order' => 3],
        ['category_slug' => 'electronics', 'name' => 'Cameras',       'slug' => 'cameras',        'sort_order' => 4],

        // Fashion
        ['category_slug' => 'fashion', 'name' => 'Men\'s Clothing', 'slug' => 'mens-clothing',   'sort_order' => 1],
        ['category_slug' => 'fashion', 'name' => 'Women\'s Clothing','slug' => 'womens-clothing', 'sort_order' => 2],
        ['category_slug' => 'fashion', 'name' => 'Footwear',         'slug' => 'footwear',        'sort_order' => 3],
        ['category_slug' => 'fashion', 'name' => 'Accessories',      'slug' => 'accessories',     'sort_order' => 4],

        // Home & Living
        ['category_slug' => 'home-living', 'name' => 'Furniture',    'slug' => 'furniture',       'sort_order' => 1],
        ['category_slug' => 'home-living', 'name' => 'Kitchen',      'slug' => 'kitchen',         'sort_order' => 2],
        ['category_slug' => 'home-living', 'name' => 'Bedding',      'slug' => 'bedding',         'sort_order' => 3],

        // Sports
        ['category_slug' => 'sports-outdoors', 'name' => 'Gym Equipment', 'slug' => 'gym-equipment', 'sort_order' => 1],
        ['category_slug' => 'sports-outdoors', 'name' => 'Cycling',       'slug' => 'cycling',        'sort_order' => 2],
        ['category_slug' => 'sports-outdoors', 'name' => 'Running',       'slug' => 'running',        'sort_order' => 3],
    ],

    'products' => [
        // Smartphones
        [
            'sub_category_slug'  => 'smartphones',
            'name'               => 'iPhone 15 Pro',
            'slug'               => 'iphone-15-pro',
            'sku'                => 'APPL-IP15P-001',
            'short_description'  => 'Apple\'s flagship with titanium design.',
            'description'        => 'The iPhone 15 Pro features a grade-5 titanium design, A17 Pro chip, and an advanced camera system with 5x optical zoom.',
            'price'              => 1199.00,
            'sale_price'         => 1099.00,
            'stock'              => 50,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=400',
            'images'             => ['https://images.unsplash.com/photo-1678685888221-cda773a3dcdb?w=800'],
            'attributes'         => ['color' => ['Black', 'White', 'Blue'], 'storage' => ['128GB', '256GB', '512GB']],
        ],
        [
            'sub_category_slug'  => 'smartphones',
            'name'               => 'Samsung Galaxy S24 Ultra',
            'slug'               => 'samsung-galaxy-s24-ultra',
            'sku'                => 'SMSNG-S24U-001',
            'short_description'  => 'Ultimate Android experience with S Pen.',
            'description'        => 'Galaxy S24 Ultra brings the most powerful Galaxy experience with a built-in S Pen, 200MP camera, and Snapdragon 8 Gen 3.',
            'price'              => 1299.00,
            'sale_price'         => null,
            'stock'              => 35,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=400',
            'images'             => ['https://images.unsplash.com/photo-1610945265064-0e34e5519bbf?w=800'],
            'attributes'         => ['color' => ['Titanium Black', 'Titanium Gray'], 'storage' => ['256GB', '512GB', '1TB']],
        ],
        [
            'sub_category_slug'  => 'smartphones',
            'name'               => 'Google Pixel 8',
            'slug'               => 'google-pixel-8',
            'sku'                => 'GOOGL-PX8-001',
            'short_description'  => 'Pure Android with Google AI features.',
            'description'        => 'Pixel 8 powered by Google Tensor G3 chip with incredible camera capabilities and seven years of OS updates.',
            'price'              => 699.00,
            'sale_price'         => 599.00,
            'stock'              => 60,
            'is_featured'        => false,
            'thumbnail'          => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400',
            'images'             => ['https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=800'],
            'attributes'         => ['color' => ['Obsidian', 'Hazel', 'Rose'], 'storage' => ['128GB', '256GB']],
        ],

        // Laptops
        [
            'sub_category_slug'  => 'laptops',
            'name'               => 'MacBook Pro 16"',
            'slug'               => 'macbook-pro-16',
            'sku'                => 'APPL-MBP16-001',
            'short_description'  => 'Professional laptop with M3 Pro chip.',
            'description'        => 'MacBook Pro with M3 Pro chip delivers extraordinary performance for demanding workflows.',
            'price'              => 2499.00,
            'sale_price'         => null,
            'stock'              => 20,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400',
            'images'             => ['https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800'],
            'attributes'         => ['color' => ['Space Black', 'Silver'], 'ram' => ['18GB', '36GB'], 'storage' => ['512GB', '1TB']],
        ],
        [
            'sub_category_slug'  => 'laptops',
            'name'               => 'Dell XPS 15',
            'slug'               => 'dell-xps-15',
            'sku'                => 'DELL-XPS15-001',
            'short_description'  => 'Premium Windows laptop with OLED display.',
            'description'        => 'Dell XPS 15 with Intel Core i9, NVIDIA RTX 4070, and a stunning 3.5K OLED touch display.',
            'price'              => 1899.00,
            'sale_price'         => 1699.00,
            'stock'              => 15,
            'is_featured'        => false,
            'thumbnail'          => 'https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=400',
            'images'             => ['https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=800'],
            'attributes'         => ['ram' => ['16GB', '32GB', '64GB'], 'storage' => ['512GB', '1TB', '2TB']],
        ],

        // Audio
        [
            'sub_category_slug'  => 'audio',
            'name'               => 'Sony WH-1000XM5',
            'slug'               => 'sony-wh-1000xm5',
            'sku'                => 'SONY-WH1KXM5-001',
            'short_description'  => 'Industry-leading noise cancelling headphones.',
            'description'        => 'Sony WH-1000XM5 delivers best-in-class noise cancellation with 30-hour battery life and Hi-Res Audio.',
            'price'              => 399.00,
            'sale_price'         => 349.00,
            'stock'              => 80,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=400',
            'images'             => ['https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?w=800'],
            'attributes'         => ['color' => ['Black', 'Silver']],
        ],

        // Men's Clothing
        [
            'sub_category_slug'  => 'mens-clothing',
            'name'               => 'Classic Oxford Shirt',
            'slug'               => 'classic-oxford-shirt',
            'sku'                => 'FASH-OXSRT-001',
            'short_description'  => 'Timeless Oxford cotton shirt for every occasion.',
            'description'        => 'Crafted from 100% premium Oxford cotton, this versatile shirt transitions effortlessly from office to weekend.',
            'price'              => 89.00,
            'sale_price'         => 69.00,
            'stock'              => 200,
            'is_featured'        => false,
            'thumbnail'          => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=400',
            'images'             => ['https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?w=800'],
            'attributes'         => ['color' => ['White', 'Light Blue', 'Grey'], 'size' => ['S', 'M', 'L', 'XL', 'XXL']],
        ],

        // Footwear
        [
            'sub_category_slug'  => 'footwear',
            'name'               => 'Nike Air Max 270',
            'slug'               => 'nike-air-max-270',
            'sku'                => 'NIKE-AM270-001',
            'short_description'  => 'Lifestyle sneaker with Max Air cushioning.',
            'description'        => 'The Nike Air Max 270 features Nike\'s biggest heel Air unit yet for an incredibly light, comfortable feel all day long.',
            'price'              => 150.00,
            'sale_price'         => 120.00,
            'stock'              => 120,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400',
            'images'             => ['https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800'],
            'attributes'         => ['color' => ['Black/White', 'Triple White', 'Red'], 'size' => ['7', '8', '9', '10', '11', '12']],
        ],

        // Furniture
        [
            'sub_category_slug'  => 'furniture',
            'name'               => 'Ergonomic Office Chair',
            'slug'               => 'ergonomic-office-chair',
            'sku'                => 'HOME-ERGCH-001',
            'short_description'  => 'Fully adjustable chair for all-day comfort.',
            'description'        => 'Engineered for long hours at your desk, this chair features lumbar support, adjustable armrests, and breathable mesh.',
            'price'              => 449.00,
            'sale_price'         => 379.00,
            'stock'              => 30,
            'is_featured'        => false,
            'thumbnail'          => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?w=400',
            'images'             => ['https://images.unsplash.com/photo-1592078615290-033ee584e267?w=800'],
            'attributes'         => ['color' => ['Black', 'Grey', 'White']],
        ],

        // Gym Equipment
        [
            'sub_category_slug'  => 'gym-equipment',
            'name'               => 'Adjustable Dumbbell Set',
            'slug'               => 'adjustable-dumbbell-set',
            'sku'                => 'SPRT-ADJDB-001',
            'short_description'  => 'Space-saving dumbbells that replace 15 sets.',
            'description'        => 'This adjustable dumbbell set replaces 15 sets of weights. Select from 5–52.5 lbs in 2.5 lb increments.',
            'price'              => 349.00,
            'sale_price'         => null,
            'stock'              => 25,
            'is_featured'        => true,
            'thumbnail'          => 'https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=400',
            'images'             => ['https://images.unsplash.com/photo-1583454110551-21f2fa2afe61?w=800'],
            'attributes'         => ['weight_range' => ['5-25 lbs', '5-52.5 lbs']],
        ],
    ],

];