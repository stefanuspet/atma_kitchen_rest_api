<?php

namespace App\Models;

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

    public function transaksi(): BelongsToMany {
        return $this->belongsToMany(Transaksi::class, 'detail_transaksi_hampers', 'id_hampers', 'id_transaksi');
    }

    public function produk(): BelongsToMany {
        return $this->belongsToMany(Produk::class, 'produk_hampers', 'id_hampers', 'id_produk');
    }

    public function packaging(): HasMany {
        return $this->hasMany(Packaging::class, "id_hampers", "id");
    }

    public function user(): BelongsTo {
        return $this->belongsTo(Hampers::class, "id_user", "id");
    }
}
