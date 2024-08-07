<?php

namespace App\Models;


use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens;
    protected $table = "users";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'nama_user',
        'email_user',
        'notelp_user',
        'password_user'
    ];

    protected $hidden = [
        'password_user',
    ];

    protected function casts(): array
    {
        return [
            'password_user' => 'hashed',
        ];
    }

    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, "id_jabatan", "id");
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

    public function saldo(): BelongsToMany
    {
        return $this->belongsToMany(Saldo::class, 'pengelolaan_saldo', 'id_user', 'id_saldo');
    }

    public function poin(): BelongsToMany
    {
        return $this->belongsToMany(Poin::class, 'pengelolaan_poin', 'id_user', 'id_poin');
    }

    // public function bahan_baku(): BelongsToMany
    // {
    //     return $this->belongsToMany(Bahan_baku::class, 'pembelian_bahan_baku', '', ' id_bahan_baku');
    // }
}
