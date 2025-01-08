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
    Schema::create('units', function (Blueprint $table) {
        $table->id('units_id'); // Assuming 'units_id' is your primary key
        $table->string('name');
        $table->string('type');
        $table->string('base_unit')->nullable();
        $table->decimal('conversion_factor', 15, 8)->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
