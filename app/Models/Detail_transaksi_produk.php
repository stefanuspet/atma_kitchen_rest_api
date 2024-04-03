<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Detail_transaksi_produk extends Pivot
{
    protected $table = "detail_transaksi_produks";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
