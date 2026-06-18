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
        Schema::create('product_transactions', function (Blueprint $table) {

            $table->id('trx_id');

            $table->unsignedBigInteger('prd_id');

            $table->enum('trx_type', ['IN', 'OUT']);
            $table->unsignedInteger('trx_qty');

            $table->date('trx_date');

            $table->text('trx_notes')->nullable();

            $table->timestamps();

            $table->foreign('prd_id')
                  ->references('prd_id')
                  ->on('products')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transactions');
    }
};