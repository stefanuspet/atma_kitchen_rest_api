<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resep extends Model
{
    protected $table = "reseps";
    protected $primaryKey = 'id';
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "takaran",
        "id_produk",
        "id_bahan_baku"
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, "id_produk", "id");
    }

    public function bahan_baku(): BelongsToMany
    {
        return $this->belongsTo(Bahan_baku::class, 'bahan_baku_resep', 'id_resep', 'id_bahan_baku');
    }
}
