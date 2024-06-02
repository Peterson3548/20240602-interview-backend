<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::firstOrCreate([
            'name' => 'acer',
        ]);

        Brand::firstOrCreate([
            'name' => 'logitech',
        ]);
    }
}
