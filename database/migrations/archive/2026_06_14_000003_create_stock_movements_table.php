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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id('movement_id');
            $table->unsignedBigInteger('product_id');
            $table->bigInteger('qty_change');
            $table->enum('movement_type', ['IN', 'OUT']);
            $table->text('description')->nullable();
            $table->timestamp('transaction_date');
            $table->timestamps();
            
            $table->index('product_id');
            $table->index('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
