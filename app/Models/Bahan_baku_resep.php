<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Bahan_baku_resep extends Pivot
{
    protected $table = "Bahan_baku_reseps";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
