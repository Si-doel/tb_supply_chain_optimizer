<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'prd_id';

    protected $fillable = [
        'sup_id',
        'prd_kode',
        'prd_nama',
        'prd_stok',
        'stok_min'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'sup_id', 'sup_id');
    }
}