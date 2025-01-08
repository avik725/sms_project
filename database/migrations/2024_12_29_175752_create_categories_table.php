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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id'); // unsignedBigInteger primary key
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id('subcategory_id'); // unsignedBigInteger primary key
            $table->unsignedBigInteger('category_id'); // Foreign key
            $table->string('subcategory');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
    }
};
