<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Pembelian_bahan_baku extends Pivot
{
    protected $table = "pembelian_bahan_bakus";
    protected $primaryKey = "id";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "jumlah_bahan_baku",
        "tanggal_pembelian",
        "total_harga",
        "id_user",
        "id_bahan_baku"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "id_user");
    }

    public function bahan_baku(): BelongsTo
    {
        return $this->belongsTo(Bahan_baku::class, "id_bahan_baku");
    }
}
