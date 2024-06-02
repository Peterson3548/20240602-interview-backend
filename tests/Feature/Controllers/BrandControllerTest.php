<?php

namespace Tests\Feature\Controllers;

use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        $brands = Brand::factory()->count(10)->create();

        $this->getJson(route('api.brands.index'))
            ->assertJson(function (AssertableJson $json) use ($brands) {
                $json->has('data', $brands->count());

                $brands->each(function (Brand $brand, int $index) use ($json) {
                    $json->has("data.$index", function (AssertableJson $json) use ($brand) {
                        $json->where('id', $brand->id)
                            ->where('name', $brand->name);
                    });
                });
            })
            ->assertOk();
    }
}
