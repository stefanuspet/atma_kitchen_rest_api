<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Pembelian_bahan_baku extends Pivot
{
    protected $table = "pembelian_bahan_bakus";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
