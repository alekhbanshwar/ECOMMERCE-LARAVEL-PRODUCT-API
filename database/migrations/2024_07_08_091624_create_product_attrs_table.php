<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("products_id")->references('id')->on('products');
            $table->string("sku");
            $table->string("attr_image")->default("NULL");
            $table->integer("mrp");
            $table->integer("price");
            $table->integer("qty");
            $table->string("size");
            $table->string("color");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attrs');
    }
};
