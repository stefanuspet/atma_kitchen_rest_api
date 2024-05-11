<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = "produks";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "nama_produk",
        "harga_produk",
        "stok_produk",
        "image",
        "id_user",
    ];

    public function bahan_baku(): BelongsToMany
    {
        return $this->belongsToMany(Bahan_baku::class, 'bahan_baku_produk', 'id_produk', 'id_bahan_baku');
    }

    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class, 'detali_transaksi_produk', 'id_produk', 'id_transaksi');
    }
    public function hampers(): BelongsToMany
    {
        return $this->belongsToMany(Hampers::class)->using(Produk_hampers::class);
    }

    public function packaging(): HasMany
    {
        return $this->hasMany(Packaging::class, "id_produk", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function resep(): BelongsTo
    {
        return $this->belongsTo(Resep::class, "id_resep", "id");
    }
}
