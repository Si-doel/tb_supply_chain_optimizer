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
        Schema::create('reorder_drafts', function (Blueprint $table) {
            $table->id('rod_id');

            $table->unsignedBigInteger('prd_id');
            $table->unsignedBigInteger('sup_id');

            $table->unsignedInteger('rod_qty');

            $table->text('rod_notes')->nullable();

            $table->timestamps();

            $table->foreign('prd_id')
                ->references('prd_id')
                ->on('products')
                ->onDelete('cascade');

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
        Schema::dropIfExists('reorder_drafts');
    }
};