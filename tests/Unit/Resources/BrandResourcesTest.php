<?php

namespace Tests\Unit\Resources;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandResourcesTest extends TestCase
{
    use RefreshDatabase;

    public function test_to_json(): void
    {
        $brand = Brand::factory()->create();

        $brandResource = BrandResource::make($brand);

        $json = json_encode(['id' => $brand->id,  'name' => $brand->name]);

        $this->assertJson($brandResource->toJson(), $json);
    }
}
