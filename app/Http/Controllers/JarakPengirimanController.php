<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Http\Resources\PesananResource;
use Illuminate\Http\Request;


class JarakPengirimanController extends Controller
{
    public function index()
    {
        return PesananResource::collection(Pesanan::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jarak' => 'required|numeric',
            'waktu' => 'required|integer'
        ]);

        $validatedData['harga'] = $this->calculatePrice($validatedData['jarak']);

        $jarakPengiriman = Pesanan::create($validatedData);

        return (new PesananResource($jarakPengiriman))->setMessage('Jarak Pengiriman created successfully');
    }

    public function show($id)
    {
        $jarakPengiriman = Pesanan::findOrFail($id);

        return (new PesananResource($jarakPengiriman))->setMessage('Jarak Pengiriman shown successfully');
    }

    public function update(Request $request, $id)
    {
        $jarakPengiriman = Pesanan::findOrFail($id);
        
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
        $jarakPengiriman = Pesanan::findOrFail($id);
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
