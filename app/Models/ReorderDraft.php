<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReorderDraft extends Model
{
    protected $primaryKey = 'rod_id';

    protected $fillable = [
        'prd_id',
        'sup_id',
        'rod_qty',
        'rod_notes'
    ];

    public function product()
    {
        return $this->belongsTo(
            Product::class,
            'prd_id',
            'prd_id'
        );
    }

    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'sup_id',
            'sup_id'
        );
    }
}