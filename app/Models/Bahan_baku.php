<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bahan_baku extends Model
{
    protected $table = "bahan_bakus";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'bahan_baku',
        'jumlah_tersedia',
        'satuan_bahan',
        'harga_satuan'
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'pembelian_bahan_baku', 'id_bahan_baku', 'id_user');
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class, 'resep', 'id_bahan_baku', 'id_produk');
    }
}
