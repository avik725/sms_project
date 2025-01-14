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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id');
            $table->unsignedBigInteger('item_id');
            $table->json('batch_ids')->nullable();
            $table->integer('quantity');
            $table->decimal('sale_price', 10, 2);
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('items_id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
