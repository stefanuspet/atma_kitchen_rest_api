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
        // return KonfirmasiPembayaranResource::collection(KonfirmasiPembayaran::all());
        return KonfirmasiPembayaranResource::collection(KonfirmasiPembayaran::with('transaksi')->get());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required',
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        $konfirmasiPembayaran = KonfirmasiPembayaran::create($validatedData);

        return (new KonfirmasiPembayaranResource($konfirmasiPembayaran))->setMessage('Konfirmasi pembayaran created successfully');
    }

    public function update(Request $request, $id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);

        $validatedData = $request->validate([
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        // $konfirmasiPembayaran->jumlah_pembayaran = $validatedData['jumlah_pembayaran'];
        // $konfirmasiPembayaran->save();
        $konfirmasiPembayaran->update($validatedData);

        return response()->json([
            'message' => 'Konfirmasi pembayaran updated successfully',
            // 'data' => $konfirmasiPembayaran
            'data' => new KonfirmasiPembayaranResource($konfirmasiPembayaran)
        ]);
    }

    // public function konfirmasi(Request $request, $id)
    // {
    //     $request->validate([
    //         'jumlah_pembayaran' => 'required|numeric',
    //     ]);

    //     $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
    //     $konfirmasiPembayaran->konfirmasi = true;
    //     $konfirmasiPembayaran->save();

    //     return response()->json([
    //         'message' => 'Pembayaran dikonfirmasi',
    //         'data' => $konfirmasiPembayaran
    //     ]);
    // }

    public function hitungTip(Request $request, $id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $transaksi = $konfirmasiPembayaran->transaksi;

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        $jumlahPembayaran = $request->input('jumlah_pembayaran');
        $tip = $jumlahPembayaran - $transaksi->harga_total;

        return response()->json(['tip' => $tip > 0 ? $tip : 0]);
    }

    public function show($id)
    {
        // $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran = KonfirmasiPembayaran::with('transaksi')->findOrFail($id);
        return (new KonfirmasiPembayaranResource($konfirmasiPembayaran))->setMessage('Konfirmasi pembayaran shown successfully');
    }

    public function destroy($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->delete();

        return response()->json([
            'message' => 'Konfirmasi pembayaran deleted successfully'
        ]);
    }
}
