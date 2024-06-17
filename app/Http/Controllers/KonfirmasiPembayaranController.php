<?php

namespace App\Http\Controllers;

use App\Models\KonfirmasiPembayaran;
use App\Models\Transaksi;
use App\Http\Controllers\Controller;
use App\Http\Resources\KonfirmasiPembayaranResource;
use Illuminate\Http\Request;

class KonfirmasiPembayaranController extends Controller
{
    public function index()
    {
        // Get all KonfirmasiPembayaran records with related Transaksi data
        $konfirmasiPembayarans = KonfirmasiPembayaran::with('transaksi')->get();

        // Return the data as a resource collection
        return response()->json(['data' => $konfirmasiPembayarans]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_transaksi' => 'required',
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        $konfirmasiPembayaran = KonfirmasiPembayaran::create($validatedData);

        return response()->json(['data' => $konfirmasiPembayaran, 'message' => 'Konfirmasi pembayaran created successfully']);
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

        return response()->json(['data' => $konfirmasiPembayaran, 'message' => 'Konfirmasi pembayaran updated successfully']);
    }

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
        $konfirmasiPembayaran = KonfirmasiPembayaran::with('transaksi')->findOrFail($id);
        return response()->json(['data' => $konfirmasiPembayaran]);
    }

    public function destroy($id)
    {
        $konfirmasiPembayaran = KonfirmasiPembayaran::findOrFail($id);
        $konfirmasiPembayaran->delete();

        return response()->json(['message' => 'Konfirmasi pembayaran deleted successfully']);
    }

    // public function paid()
    // {
    //     $konfirmasiPembayarans = KonfirmasiPembayaran::whereHas('transaksi', function ($query) {
    //         $query->where('status_pesanan', 'Sudah Dibayar');
    //     })->with('transaksi')->get();

    //     if ($konfirmasiPembayarans->isEmpty()) {
    //         return response()->json(['message' => 'No transactions found'], 404);
    //     }

    //     return response()->json(['data' => $konfirmasiPembayarans]);
    // }
    public function getSudahBayar()
    {
        // Ensure correct status is used for filtering
        $transaksis = Transaksi::where('status_pesanan', 'Sudah Dibayar')->get();

        if ($transaksis->isEmpty()) {
            return response()->json(['message' => 'No transactions found'], 404);
        }

        return response()->json([
            'data' => $transaksis
        ]);
    }

    // public function getSudahBayar()
    // {
    //     // Get all KonfirmasiPembayaran records with related Transaksi data where status_pesanan is 'Sudah Dibayar'
    //     $konfirmasiPembayarans = KonfirmasiPembayaran::whereHas('transaksi', function ($query) {
    //         $query->where('status_pesanan', 'Sudah Dibayar');
    //     })->with('transaksi')->get();

    //     if ($konfirmasiPembayarans->isEmpty()) {
    //         return response()->json(['message' => 'No transactions found'], 404);
    //     }

    //     return response()->json(['data' => $konfirmasiPembayarans]);
    // }
}
