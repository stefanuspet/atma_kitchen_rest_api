<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pengeluaran_lain extends Model
{
    protected $table = "pengeluaran_lains";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    protected $fillable = [
        'nama_pengeluaran',
        'total_pengeluaran',
        'tanggal_pengeluaran',
        "id_user",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', "id");
    }

    // public function produk(): BelongsToMany
    // {
    //     return $this->belongsToMany(Produk::class, 'pengeluaran_lain_produk', 'id_pengeluaran_lain', 'id_produk');
    // }
}
