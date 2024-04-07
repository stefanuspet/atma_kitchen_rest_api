<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Pengelolaan_poin extends Pivot
{
    protected $table = "pengelolaan_poins";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
