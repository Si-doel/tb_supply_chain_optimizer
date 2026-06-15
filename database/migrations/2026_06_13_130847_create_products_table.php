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
        Schema::create('products', function (Blueprint $table) {

            $table->id('prd_id');

            $table->unsignedBigInteger('sup_id');

            $table->string('prd_kode', 20)->unique();
            $table->string('prd_nama', 100);

            $table->integer('prd_stok')->default(0);
            $table->integer('stok_min')->default(0);

            $table->timestamps();

            $table->foreign('sup_id')
                  ->references('sup_id')
                  ->on('suppliers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};