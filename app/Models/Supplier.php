<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $primaryKey = 'sup_id';

    protected $fillable = [
        'sup_kode',
        'sup_nama',
        'sup_alamat',
        'sup_telp',
        'sup_email'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'sup_id', 'sup_id');
    }
}