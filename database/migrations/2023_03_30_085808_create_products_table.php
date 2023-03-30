<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('product_id', 20)->primary();
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->decimal('product_price')->default(0);
            $table->boolean('is_sales')->default(1);
            $table->text('description')->nullable();
            $table->nullableTimestamps();
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
