<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bahan_baku extends Model
{
    protected $table = "bahan_bakus";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class);
    }
}
