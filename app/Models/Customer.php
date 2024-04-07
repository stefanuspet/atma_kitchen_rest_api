<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    protected $table = "customers";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function alamat() : HasMany {
        return $this->hasMany(Alamat::class, "id_customer", "id");
    }

    public function saldo() : HasOne {
        return $this->hasOne(Saldo::class, "id_customer", "id");
    }

    public function poin() : HasOne {
        return $this->hasOne(Poin::class, "id_customer", "id");
    }
    
    public function transaksi() : HasMany {
        return $this->hasMany(Transaksi::class, "id_customer", "id");
    }
}
