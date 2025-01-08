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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('purchase_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('quantity');
            $table->date('expiry_date')->nullable(); // Optional for items without expiry
            $table->enum('status', ['order placed', 'fulfilled'])->default('order placed');
            $table->unsignedBigInteger('batch_id')->nullable(); // Added for tracking fulfilled batches
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            $table->foreign('item_id')->references('items_id')->on('items')->onDelete('cascade');
            $table->foreign('supplier_id')->references('suppliers_id')->on('suppliers')->onDelete('cascade');
            $table->foreign('batch_id')->references('batch_id')->on('batches')->onDelete('set null'); // Maintain batch reference
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
