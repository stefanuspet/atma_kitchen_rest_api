<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Resep extends Pivot
{
    protected $table = "reseps";
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;
}
