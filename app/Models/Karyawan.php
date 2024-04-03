<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Karyawan extends Model
{
    protected $table = "karyawans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function presensi() : HasMany {
        return $this->hasMany(Presensi::class, "id_karyawan", "id");
    }
    public function gaji() : HasMany {
        return $this->hasMany(Gaji::class, "id_karyawan", "id");
    }
}
