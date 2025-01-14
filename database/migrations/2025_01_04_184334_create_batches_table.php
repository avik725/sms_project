<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id('batch_id');
            $table->unsignedBigInteger('item_id'); // Link to the items table
            $table->unsignedBigInteger('supplier_id'); // Link to the suppliers table
            $table->integer('quantity'); // Quantity of the item in this batch
            $table->date('expiry_date')->nullable(); // Expiry date for perishable items
            $table->timestamps();
            $table->softDeletes();
        
            // Foreign keys
            $table->foreign('item_id')->references('items_id')->on('items')->onDelete('cascade');
            $table->foreign('supplier_id')->references('suppliers_id')->on('suppliers')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('batches');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
