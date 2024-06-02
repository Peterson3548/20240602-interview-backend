<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('產品名稱');
            $table->foreignId('brand_id')->constrained();
            $table->unsignedBigInteger('official_price')->comment('官方標價');
            $table->unsignedBigInteger('actual_price')->comment('實際售價');
            $table->string('image_path')->comment('產品圖片路徑');
            $table->timestamps();

            $table->unique(['name', 'brand_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
