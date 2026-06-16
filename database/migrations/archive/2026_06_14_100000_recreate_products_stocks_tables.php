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
        // Disable foreign key checks temporarily
        Schema::disableForeignKeyConstraints();

        // Drop existing tables if they exist (buat clean slate)
        if (Schema::hasTable('stocks')) {
            Schema::dropIfExists('stocks');
        }
        if (Schema::hasTable('stock_movements')) {
            Schema::dropIfExists('stock_movements');
        }
        if (Schema::hasTable('products')) {
            Schema::dropIfExists('products');
        }

        // Re-enable foreign key checks
        Schema::enableForeignKeyConstraints();

        // Create fresh products table
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('product_code', 50)->unique();
            $table->string('product_name', 150);
            $table->string('category', 50);
            $table->bigInteger('purchase_price')->default(0);
            $table->bigInteger('selling_price')->default(0);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('unit', 20)->default('pcs');
            $table->timestamps();
            
            // Foreign key
            $table->foreign('supplier_id')->references('sup_id')->on('suppliers')->onDelete('set null');
        });

        // Create stocks table
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id');
            $table->unsignedBigInteger('product_id');
            $table->string('warehouse_location', 100)->default('Main Warehouse');
            $table->bigInteger('qty_current')->default(0);
            $table->bigInteger('qty_minimum')->default(10);
            $table->bigInteger('qty_maximum')->default(100);
            $table->timestamp('last_replenished')->nullable();
            $table->timestamps();
            
            // Foreign key
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->index('product_id');
        });

        // Create stock_movements table
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id('movement_id');
            $table->unsignedBigInteger('product_id');
            $table->bigInteger('qty_change');
            $table->enum('movement_type', ['IN', 'OUT']);
            $table->text('description')->nullable();
            $table->timestamp('transaction_date');
            $table->timestamps();
            
            // Foreign key
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('stocks');
        Schema::dropIfExists('products');
    }
};
