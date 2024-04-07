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

    public function produk_penitip(): BelongsToMany {
        return $this->belongsToMany(Produk_penitip::class, 'detail_transaksi_produk_penitip', 'id_transaksi', 'id_produk_penitip');
    }

    public function produk(): BelongsToMany {
        return $this->belongsToMany(Produk::class, 'detali_transaksi_produk', 'id_transaksi', 'id_produk');
    }

    public function hampers(): BelongsToMany {
        return $this->belongsToMany(Hampers::class, 'detail_transaksi_hampers', 'id_transaksi', 'id_hampers');
    }

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class, "id_customer", "id");
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function packaging(): BelongsTo {
        return $this->belongsTo(Packaging::class, "id_packaging", "id");
    }
}
