<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductResourcesTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_json(): void
    {
        $product = Product::factory()->create();

        $productResource = ProductResource::make($product);

        $json = json_encode([
            'name' => $product->name,
            'product' => [
                'id' => $product->brand->id,
                'name' => $product->brand->id,
            ],
            'official_price' => $product->official_price,
            'actual_price' => $product->actual_price,
            'image_url' => $product->image_url,
        ]);

        $this->assertJson($productResource->toJson(), $json);
    }
}
