<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->json('batch_ids')->nullable()->after('sale_price');  // Ensure it's after the 'sale_price' column
        });
    }
    
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('batch_ids');
        });
    }
    
};
