<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Produk_hampers extends Pivot
{
    protected $table = "hampers_produk";
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        "id_produk",
        "id_hampers",
        // "stok_hampers",
    ];
}
