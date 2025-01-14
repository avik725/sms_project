<?php

// Migration File

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('items_id');
            $table->string('item');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('measurement_category', ['Weight', 'Volume', 'Count']);
            $table->unsignedBigInteger('units_id');
            $table->decimal('measurement_value', 8, 2); // E.g., weight in kg, volume in liters
            $table->decimal('buying_price', 10, 2); // Price in Indian Rupees
            $table->decimal('selling_price', 10, 2); // Price in Indian Rupees
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('subcategory_id')->on('subcategories')->onDelete('cascade');
            $table->foreign('units_id')->references('units_id')->on('units')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('items');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};