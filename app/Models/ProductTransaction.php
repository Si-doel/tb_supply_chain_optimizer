<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $primaryKey = 'trx_id';

    protected $fillable = [
        'prd_id',
        'trx_type',
        'trx_qty',
        'trx_date',
        'trx_notes'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'prd_id', 'prd_id');
    }
}