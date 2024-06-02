<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brands = Brand::get();

        $products = collect([
            [
                'name' => '外接硬碟',
                'official_price' => 2599,
                'actual_price' => 1480,
                'image_path' => 'images/PSD.jpg',
            ],
            [
                'name' => '筆電',
                'official_price' => 26900,
                'actual_price' => 19900,
                'image_path' => 'images/laptop.jpg',
            ],
            [
                'name' => '繪圖工作站',
                'official_price' => 77900,
                'actual_price' => 66900,
                'image_path' => 'images/laptop-draw.jpg',
            ],
            [
                'name' => '螢幕',
                'official_price' => 9900,
                'actual_price' => 5500,
                'image_path' => 'images/monitor.jpg',
            ],
        ]);

        $products->each(function (array $product) use ($brands) {
            $brands->each(function (Brand $brand) use ($product) {
                data_set($product, 'brand_id', $brand->id);

                $this->create($product);
            });
        });
    }

    private function create(array $product): void
    {
        Product::firstOrCreate(
            [
                'name' => data_get($product, 'name'),
                'brand_id' => data_get($product, 'brand_id'),
            ],
            [
                'official_price' => data_get($product, 'official_price'),
                'actual_price' => data_get($product, 'actual_price'),
                'image_path' => data_get($product, 'image_path'),
            ]
        );
    }
}
