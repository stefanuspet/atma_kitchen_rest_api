<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = "produks";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function bahan_baku(): BelongsToMany
    {
        return $this->belongsToMany(Bahan_baku::class);
    }

    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class);
    }
    public function hampers(): BelongsToMany
    {
        return $this->belongsToMany(Hampers::class);
    }

    public function packaging(): HasMany
    {
        return $this->hasMany(Packaging::class, "id_produk", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Produk::class, "id_user", "id");
    }
}
