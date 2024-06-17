<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class JarakPengiriman extends Model
{
    protected $table = "jarak_pengirimans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "jarak",
        "harga",
        "waktu",
    ];

    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, "id_jarak_pengiriman", "id");
    }
}
