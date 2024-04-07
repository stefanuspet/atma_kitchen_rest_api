<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran_lain extends Model
{
    protected $table = "pengeluaran_lains";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "id_user", "id");
    }
}
