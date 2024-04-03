<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaksi extends Model
{
    protected $table = "transaksis";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $timestamps = true;
    public $incrementing = false;

    public function produk_penitip(): BelongsToMany
    {
        return $this->belongsToMany(Produk_penitip::class);
    }

    public function produk(): BelongsToMany
    {
        return $this->belongsToMany(Produk::class);
    }
    public function hampers(): BelongsToMany
    {
        return $this->belongsToMany(Hampers::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, "id_customer", "id");
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user", "id");
    }
    public function packaging(): BelongsTo
    {
        return $this->belongsTo(Packaging::class, "id_packaging", "id");
    }
}
