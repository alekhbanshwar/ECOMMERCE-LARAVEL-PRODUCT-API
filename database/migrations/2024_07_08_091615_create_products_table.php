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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('image')->default("NULL");
            $table->string('slug');
            $table->string('brand');
            $table->string('model');
            $table->text('short_desc')->default("NULL");
            $table->text('desc')->default("NULL");
            $table->text('keywords')->default("NULL");
            $table->text('technical_specification')->default("NULL");
            $table->text('uses')->default("NULL");
            $table->string("lead_time")->default("NULL");
            $table->string("tax")->default("NULL");
            $table->integer("is_promo");
            $table->integer("is_featured");
            $table->integer("is_discounted");
            $table->integer("is_tranding");
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
