<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\JarakPengiriman;
use App\Http\Resources\PesananResource;
use Illuminate\Http\Request;

class JarakPengirimanController extends Controller
{
    public function index()
    {
        return PesananResource::collection(JarakPengiriman::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jarak' => 'required|numeric',
            'waktu' => 'required|integer',
            'id_transaksi' => 'required|exists:transaksis,id'
        ]);

        $validatedData['harga'] = $this->calculatePrice($validatedData['jarak']);

        $jarakPengiriman = JarakPengiriman::create($validatedData);

        return (new PesananResource($jarakPengiriman))->setMessage('Jarak Pengiriman created successfully');
    }

    public function show($id)
    {
        $jarakPengiriman = JarakPengiriman::findOrFail($id);

        return (new PesananResource($jarakPengiriman))->setMessage('Jarak Pengiriman shown successfully');
    }

    public function update(Request $request, $id)
    {
        $jarakPengiriman = JarakPengiriman::findOrFail($id);
        
        $validatedData = $request->validate([
            'jarak' => 'required|numeric',
            'waktu' => 'required|integer'
        ]);
        
        $validatedData['harga'] = $this->calculatePrice($validatedData['jarak']);
        
        $jarakPengiriman->update($validatedData);

        return (new PesananResource($jarakPengiriman))->setMessage('Jarak Pengiriman updated successfully');
    }

   public function destroy($id)
    {
        $jarakPengiriman = JarakPengiriman::findOrFail($id);
        $jarakPengiriman->delete();

        return response()->json(null, 204);
    }

    private function calculatePrice($jarak)
    {
        if ($jarak <= 5) {
            return 10000;
        } else if ($jarak <= 10) {
            return 15000;
        } else if ($jarak <= 15) {
            return 20000;
        } else {
            return 25000;
        }
    }
}
