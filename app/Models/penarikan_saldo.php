<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penarikan_saldo extends Model
{
    use HasFactory;

    protected $table = "penarikan_saldos";

    protected $fillable = [
        "jumlah_penarikan",
        "tanggal_penarikan",
        'trasfered'
    ];
}
