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
        Schema::create('inventory_tracking', function (Blueprint $table) {
            $table->id('inventory_tracking_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('batch_id');
            $table->enum('change_type', ['restock', 'sale', 'damage']);
            $table->decimal('change_quantity', 10, 2);
            $table->decimal('remaining_stock', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('item_id')->references('items_id')->on('items')->onDelete('cascade');
            $table->foreign('batch_id')->references('batch_id')->on('batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_tracking');
    }
};
