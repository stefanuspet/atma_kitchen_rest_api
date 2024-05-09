<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens;
    protected $table = "customers";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'nama_customer',
        'email_customer',
        'notelp_customer',
        "password_customer",
        'verify_key',
        'active',
    ];

    protected $hidden = [
        'password_customer',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'password_customer' => 'hashed',
        ];
    }

    public function alamat(): HasMany
    {
        return $this->hasMany(Alamat::class, "id_customer", "id");
    }

    public function saldo(): HasOne
    {
        return $this->hasOne(Saldo::class, "id_customer", "id");
    }

    public function poin(): HasOne
    {
        return $this->hasOne(Poin::class, "id_customer", "id");
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, "id_customer", "id");
    }
}
