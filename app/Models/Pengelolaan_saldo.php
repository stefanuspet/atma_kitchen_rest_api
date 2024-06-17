<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Pengelolaan_saldo extends Pivot
{
    protected $table = "pengelolaan_saldos";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
