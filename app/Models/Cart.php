<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "carts";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'id_produk',
        'id_customer',
        'id_hampers',
        'id_produk_penitip',
        'total',
        "loyang",
        'jumlah_produk',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function hampers()
    {
        return $this->belongsTo(Hampers::class, 'id_hampers', 'id');
    }

    public function produk_penitip()
    {
        return $this->belongsTo(Produk_penitip::class, 'id_produk_penitip', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
