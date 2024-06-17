<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenarikanSaldoResource;
use App\Models\penarikan_saldo;
use Illuminate\Http\Request;

class PenarikanSaldoController extends Controller
{
    public function index()
    {
        return PenarikanSaldoResource::collection(penarikan_saldo::all());
    }

    public function updateTrasfered($id)
    {
        $penarikan_saldo = penarikan_saldo::findOrFail($id);
        $penarikan_saldo->trasfered = 'SUCCESS';
        $penarikan_saldo->save();

        return (new PenarikanSaldoResource($penarikan_saldo))->setMessage('Penarikan Saldo updated successfully');
    }
}
