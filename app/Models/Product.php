<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductTransaction;

class Product extends Model
{
    protected $primaryKey = 'prd_id';

    protected $fillable = [
        'sup_id',
        'prd_kode',
        'prd_nama',
        'prd_stok',
        'stok_min',
        'hpp',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
    }

    public function transactions()
    {
        return $this->hasMany(
            ProductTransaction::class,
            'prd_id',
            'prd_id'
        );
    }

    public function getMeanAttribute()
    {
        $outTransactions = $this->transactions()
            ->where('trx_type', 'OUT');

        $totalOut = $outTransactions->sum('trx_qty');

        $jumlahTransaksi = $outTransactions->count();

        if ($jumlahTransaksi > 0) {
            return round($totalOut / $jumlahTransaksi, 1);
        }

        return 5;
    }

    public function getDsiAttribute()
    {
        return round(
            $this->prd_stok / $this->mean,
            1
        );
    }

    public function getInventoryStatusAttribute()
    {
        if (
            $this->dsi > 30
        ) {
            return 'Overstock';
        }

        if (
            $this->prd_stok <= $this->stok_min*1.5
        ) {
            return 'Stockout';
        }

        return 'Normal';
    }

    public function getInventoryValueAttribute()
    {
        return $this->prd_stok * $this->hpp;
    }

}

