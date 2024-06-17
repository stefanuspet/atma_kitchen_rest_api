<?php

namespace App\Http\Controllers;

use App\Models\KonfirmasiPembayaran;
use App\Http\Controllers\Controller;
use App\Http\Resources\KonfirmasiPembayaranResource;
use Illuminate\Http\Request;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::where('konfirmasi', false)->get();
        return response()->json($konfirmasiPembayaran);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'harga' => 'required|numeric',
        ]);

        $konfirmasiPembayaran = KonfirmasiPembayaran::create($validatedData);

        return (new KonfirmasiPembayaran($konfirmasiPembayaran))->setMessage('Konfirmasi pembayaran created successfully');
    }

    public function update(Request $request, $id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        
        $validatedData = $request->validate([
            'harga' => 'required|numeric',
        ]);
        
        $konfirmasiPembayaran->update($validatedData);

        return (new KonfirmasiPembayaranResource($konfirmasiPembayaran))->setMessage('Jarak Pengiriman updated successfully');
    }

    public function konfirmasi(Request $request, $id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->konfirmasi = true;
        $konfirmasiPembayaran->save();

        return response()->json(['message' => 'Pembayaran dikonfirmasi']);
    }

    public function hitungTip(Request $request, $id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $jumlahPembayaran = $request->input('jumlah_pembayaran');
        $tip = $jumlahPembayaran - $konfirmasiPembayaran->jumlah_pembayaran;

        return response()->json(['tip' => $tip > 0 ? $tip : 0]);
    }

    public function show($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        return response()->json($konfirmasiPembayaran);
    }

    public function destroy($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->delete();

        return response()->json(null, 204);
    }
}
