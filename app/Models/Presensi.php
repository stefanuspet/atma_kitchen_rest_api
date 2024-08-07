<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Presensi extends Model
{
    protected $table = "presensis";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "tanggal_presensi",
        "Status",
        "id_karyawan"
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, "id_karyawan", "id");
    }
}
