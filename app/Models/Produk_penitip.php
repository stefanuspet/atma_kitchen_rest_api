<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Produk_penitip extends Model
{
    protected $table = "produk_penitips";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "nama_produk_penitip",
        "harga_produk_penitip",
        "stok_produk_penitip",
        "gambar_produk_penitip",
        "id_penitip",
        "id_user"
    ];

    public function penitip(): BelongsTo
    {
        return $this->belongsTo(Penitip::class, "id_penitip", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi_produk_penitip', 'id_produk_penitip', 'id_transaksi');
    }
}
