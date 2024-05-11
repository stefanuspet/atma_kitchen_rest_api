<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hampers extends Model
{
    protected $table = "hampers";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "nama_hampers",
        "harga_hampers",
        "deskripsi_hampers",
        "tanggal_pembuatan_hampers",
        "stok_hampers",
        "id_user",
    ];
    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi_hampers', 'id_hampers', 'id_transaksi');
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class)->using(Produk_hampers::class);
    }

    public function packaging(): HasMany
    {
        return $this->hasMany(Packaging::class, "id_hampers", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Hampers::class, "id_user", "id");
    }
}
