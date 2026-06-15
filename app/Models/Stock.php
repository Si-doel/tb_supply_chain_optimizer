<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    protected $primaryKey = 'stock_id';

    protected $fillable = [
        'product_id',
        'warehouse_location',
        'qty_current',
        'qty_minimum',
        'qty_maximum',
        'last_replenished',
    ];

    protected $casts = [
        'last_replenished' => 'datetime',
    ];

    /**
     * Relationship: Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    /**
     * Get health status (Optimal, Low, Critical)
     */
    public function getHealthStatus()
    {
        if ($this->qty_current >= $this->qty_minimum) {
            return 'Optimal';
        } elseif ($this->qty_current >= ($this->qty_minimum / 2)) {
            return 'Low';
        } else {
            return 'Critical';
        }
    }
}
