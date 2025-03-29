<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id'); // Product name
            $table->string('category')->nullable(); // Product category
            $table->string('sub_category')->nullable(); // Product category
            $table->decimal('price', 10, 2)->nullable(); // Product price
            $table->text('description')->nullable(); // Product description
            $table->string('image')->nullable(); // Product image
            $table->string('status')->nullable(); // Product status
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'category','sub_category', 'price', 'description', 'image', 'status']);
        });
    }
};