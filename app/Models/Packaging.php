<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packaging extends Model
{
    protected $table = "packagings";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, "id_produk", "id");
    }
    public function hampers(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, "id_hampers", "id");
    }
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, "id_packaging", "id");
    }
}
