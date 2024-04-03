<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Produk_hampers extends Pivot
{
    protected $table = "produk_hampers";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
