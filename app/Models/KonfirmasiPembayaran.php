<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonfirmasiPembayaran extends Model
{
    protected $table = "konfirmasi_pembayarans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "id_transaksi",
        "jumlah_pembayaran",
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, "id_transaksi", "id");
    }
}
