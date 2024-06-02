<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = collect(['toshiba', 'asus', 'msi', 'acer', 'avita']);

        $brands->each(function (string $name) {
            Brand::firstOrCreate([
                'name' => $name,
            ]);
        });
    }
}
