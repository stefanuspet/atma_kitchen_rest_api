<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Detail_transaksi_produk_penitip extends Pivot
{
    protected $table = "detail_transaksi_produk_penitips";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
