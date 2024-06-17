<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penitip extends Model
{
    protected $table = "penitips";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "nama_penitip",
        "email_penitip",
        "notelp_penitip"
    ];

    public function produk_penitip(): HasMany
    {
        return $this->hasMany(Produk_penitip::class, "id_penitip", "id");
    }
}
