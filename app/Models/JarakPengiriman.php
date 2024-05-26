<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JarakPengiriman extends Model
{
    protected $table = "jarak_pengirimans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "jarak",
        "harga",
        "waktu"
    ];
}
