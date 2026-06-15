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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id');
            $table->unsignedBigInteger('product_id');
            $table->string('warehouse_location', 100)->default('Main Warehouse');
            $table->bigInteger('qty_current')->default(0);
            $table->bigInteger('qty_minimum')->default(10);
            $table->bigInteger('qty_maximum')->default(100);
            $table->timestamp('last_replenished')->nullable();
            $table->timestamps();
            
            $table->index('product_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
