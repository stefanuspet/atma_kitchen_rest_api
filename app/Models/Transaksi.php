<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    protected $table = "transaksis";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "tanggal_transaksi",
        "tanggal_ambil",
        "tanggal_lunas",
        "metode_pembayaran",
        // "status_pembayaran",
        // "status_pengiriman",
        "status_pesanan", // "Belum Dibayar", "Sudah Dibayar", "Sudah Dikirim", "Sudah Diterima
        "jenis_pengiriman",
        "tip",
        "jarak",
        "ongkir",
        "potongan_poin",
        "poin_pesanan",
        "harga_setelah_poin",
        "harga_setelah_ongkir",
        "harga_total",
        "id_customer",
        "id_packaging",
    ];

    public function produk_penitip(): BelongsToMany
    {
        return $this->belongsToMany(Produk_penitip::class, 'detail_transaksis', 'id_transaksi', 'id_produk_penitip');
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksis', 'id_transaksi', 'id_produk');
    }

    public function hampers(): BelongsToMany
    {
        return $this->belongsToMany(Hampers::class, 'detail_transaksis', 'id_transaksi', 'id_hampers');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, "id_customer", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function packaging(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, "id_packaging", "id");
    }

    public function jarakPengiriman(): HasOne
    {
        return $this->hasOne(JarakPengiriman::class, "id_transaksi", "id");
    }
}