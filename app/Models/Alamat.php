<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alamat extends Model
{
    protected $table = "customers";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Alamat::class, "id_customer", "id");
    }
}
