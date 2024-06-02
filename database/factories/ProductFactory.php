<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name('產品名稱'),
            'brand_id' => Brand::factory()->create(),
            'official_price' => fake()->randomNumber(),
            'actual_price' => fake()->randomNumber(),
            'image_path' => '123',
        ];
    }
}
