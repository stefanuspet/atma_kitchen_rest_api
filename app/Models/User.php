<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_jabatan", "id");
    }

    public function gaji(): HasMany
    {
        return $this->hasMany(Gaji::class, "id_user", "id");
    }
    public function hampers(): HasMany
    {
        return $this->hasMany(Hampers::class, "id_user", "id");
    }
    public function produk_penitip(): HasMany
    {
        return $this->hasMany(Produk_penitip::class, "id_user", "id");
    }
    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, "id_user", "id");
    }

    public function pengeluaran_lain(): HasMany
    {
        return $this->hasMany(Pengeluaran_lain::class, "id_user", "id");
    }
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, "id_user", "id");
    }

    public function pengelolaan_saldo(): BelongsToMany
    {
        return $this->belongsToMany(Saldo::class);
    }

    public function pengelolaan_poin(): BelongsToMany
    {
        return $this->belongsToMany(Poin::class);
    }

    public function bahan_baku(): BelongsToMany
    {
        return $this->belongsToMany(Bahan_baku::class);
    }
}
