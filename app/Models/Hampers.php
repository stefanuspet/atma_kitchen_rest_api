<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hampers extends Model
{
    protected $table = "hampers";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function transaksi(): BelongsToMany
    {
        return $this->belongsToMany(Transaksi::class);
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class);
    }

    public function packaging(): HasMany
    {
        return $this->hasMany(Hampers::class, "id_hampers", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(Hampers::class, "id_user", "id");
    }
}
