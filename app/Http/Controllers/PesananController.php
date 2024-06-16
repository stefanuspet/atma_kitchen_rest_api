<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\PesananResource;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return PesananResource::collection(Pesanan::with('jarakPengiriman')->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'id_jarak_pengiriman' => 'required|exists:jarak_pengirimans,id'
        ]);

        $pesanan = Pesanan::create($validatedData);

        return (new PesananResource($pesanan))->setMessage('Pesanan created successfully');
    }

    public function show($id)
    {
        $pesanan = Pesanan::with('jarakPengiriman')->findOrFail($id);
        return (new PesananResource($pesanan))->setMessage('Pesanan shown successfully');
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_produk' => 'required|string',
            'id_jarak_pengiriman' => 'required|exists:jarak_pengirimans,id'
        ]);

        $pesanan->update($validatedData);

        return (new PesananResource($pesanan))->setMessage('Pesanan updated successfully');
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return response()->json([
            'message' => 'Pesanan deleted successfully'
        ]);
    }
}
