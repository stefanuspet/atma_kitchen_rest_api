<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    protected $table = "pesanans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "nama_produk",
        "id_jarak_pengiriman",
    ];

    public function jarakPengiriman(): BelongsTo
    {
        return $this->belongsTo(JarakPengiriman::class, "id_jarak_pengiriman", "id");
    }
}
