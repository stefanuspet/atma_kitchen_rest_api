<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Saldo extends Model
{
    protected $table = "saldos";
    protected $primaryKey = "id";
    protected $keyType = "int";
    public $timestamps = true;
    public $incrementing = true;

    public function customer(): BelongsTo {
        return $this->belongsTo(Customer::class, "id_customer", "id");
    }

    public function user(): BelongsToMany {
        return $this->belongsToMany(User::class, 'pengelolaan_saldo', 'id_saldo', 'id_user');
    }
}
