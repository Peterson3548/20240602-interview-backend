<?php

namespace Tests\Feature\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $products = Product::factory()->count(10)->create();

        $this->getJson(route('api.products.index'))
            ->assertJson(function (AssertableJson $json) use ($products) {
                $json->has('data', $products->count());

                $products->each(function (Product $product, int $index) use ($json) {
                    $json->has("data.$index", function (AssertableJson $json) use ($product) {
                        $json->has('brand', function (AssertableJson $json) use ($product) {
                            $json->where('id', $product->brand->id)
                                ->where('name', $product->brand->name);
                        })
                            ->where('name', $product->name)
                            ->where('official_price', $product->official_price)
                            ->where('actual_price', $product->actual_price)
                            ->where('image_url', $product->image_url);
                    })
                        ->has('links', function (AssertableJson $json) {
                            $json->has('first')
                                ->has('last')
                                ->has('prev')
                                ->has('next');
                        })
                        ->has('meta', function (AssertableJson $json) {
                            $json->has('current_page')
                                ->has('from')
                                ->has('last_page')
                                ->has('links')
                                ->has('path')
                                ->has('per_page')
                                ->has('to')
                                ->has('total');
                        });
                });
            })
            ->assertOk();
    }
}
