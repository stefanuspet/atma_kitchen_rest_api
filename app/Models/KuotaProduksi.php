<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuotaProduksi extends Model
{
    use HasFactory;

    protected $table = "kuota_produksis";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "max_produksi",
        "tanggal",
        "id_produk",
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, "id_produk", "id");
    }
}
