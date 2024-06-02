<?php

namespace Tests\Unit\Resources;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_relation(): void
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()
            ->state([
                'brand_id' => $brand,
            ])
            ->create();

        $this->assertEquals($brand->toArray(), $product->brand->toArray());
    }
}
