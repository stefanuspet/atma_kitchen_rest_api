<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Bahan_baku_produk extends Pivot
{
    protected $table = "bahan_baku_produks";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
