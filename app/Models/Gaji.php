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

    protected $fillable = [
        "honor_harian",
        "bonus",
        "id_user",
        "id_karyawan"
    ];

    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class, "id_karyawan", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }
}
