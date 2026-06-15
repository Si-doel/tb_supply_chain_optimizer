<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_code',
        'product_name',
        'category',
        'purchase_price',
        'selling_price',
        'supplier_id',
        'unit',
    ];

    /**
     * Relationship: Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'sup_id');
    }

    /**
     * Relationship: Stock
     */
    public function stock()
    {
        return $this->hasOne(Stock::class, 'product_id', 'product_id');
    }

    /**
     * Relationship: Stock Movements
     */
    public function movements()
    {
        return $this->hasMany(StockMovement::class, 'product_id', 'product_id');
    }
}
