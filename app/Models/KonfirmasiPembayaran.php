<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfirmasiPembayaran extends Model
{
    protected $table = "konfirmasi_pembayarans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "harga",
    ];
}
