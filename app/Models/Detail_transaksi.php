<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Detail_transaksi extends Pivot
{
    use HasFactory;

    protected $table = "detail_transaksis";
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "id_transaksi",
        "id_produk",
        "id_produk_penitip",
        "id_hampers",
    ];
}
