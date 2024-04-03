<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gaji extends Model
{
    protected $table = "gajis";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Gaji::class, "id_karyawan", "id");
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(Gaji::class, "id_user", "id");
    }
}
