<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jabatan extends Model
{
    protected $table = "jabatans";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        "deskripsi_jabatan",
        "nama_jabatan"
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class, "id_jabatan", "id");
    }
}
