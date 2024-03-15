<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\ActivityLogService;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogService $service)
    {

        $products = array(

            // medicine
            [
                'id' => 1,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Muculer',
                'slug' => Str::slug('Muculer'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Symdex-D',
                'slug' => Str::slug('Symdex-D'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Metformin',
                'slug' => Str::slug('Metformin'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 4,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Paracetamol For Kids',
                'slug' => Str::slug('Paracetamol For Kids'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 5,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Dicyrine',
                'slug' => Str::slug('Dicyrine'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 6,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Glimepiride',
                'slug' => Str::slug('Glimepiride'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 7,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Amoxicillin',
                'slug' => Str::slug('Amoxicillin'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 8,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Diclofenac',
                'slug' => Str::slug('Diclofenac'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 9,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Amlodepine',
                'slug' => Str::slug('Amlodepine'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 10,
                'category_id' => 2,
                'code' => mt_rand(123456,999999),
                'name' => 'Losartan',
                'slug' => Str::slug('Losartan'),
                'description' => 'Sample Description',
                'price' => mt_rand(123,999),
                'qty' => 50,
                'manufactured_at' => now()->subYear(),
                'expired_at' => now()->addYear(),
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );

        Product::insert($products);

        Product::all()->each(function($product) use($service) {
            $service->log_activity(model:$product, event:'added', model_name: 'Product', model_property_name: $product->name);
        });
    }
}