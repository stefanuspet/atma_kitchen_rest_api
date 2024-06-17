<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JarakPengiriman extends Model
{
    use HasFactory;

    protected $table = 'jarak_pengirimen';

    protected $fillable = [
        'jarak',
        'waktu',
        'harga',
        'id_transaksi',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, "id_transaksi", "id");
    }
}
