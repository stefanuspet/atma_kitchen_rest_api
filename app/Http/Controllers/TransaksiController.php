<?php

namespace App\Http\Controllers;

use App\Models\Poin;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // index
    public function index()
    {
        $transaksis = Transaksi::all();
        return response()->json([
            'data' => $transaksis
        ]);
    }

    public function checkout(Request $request)
    {
        // validation
        $request->validate([
            'tanggal_ambil' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengiriman' => 'required',
            'potongan_poin' => 'required|numeric|min:0',
            'harga_pengurangan_poin' => 'required|numeric',
        ]);


        $transaksi = new Transaksi();
        $transaksi->tanggal_transaksi = date('Y-m-d H:i');
        $transaksi->tanggal_ambil = $request->tanggal_ambil;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->status_pembayaran = "Belum Dibayar";
        $transaksi->status_pengiriman = $request->status_pengiriman;
        $transaksi->jenis_pengiriman = $request->jenis_pengiriman;
        $transaksi->tip = $request->tip;
        $transaksi->ongkir = $request->ongkir;
        $customerid = Auth::user()->id;
        // get jumlah_poin customer
        $poin_customer = Poin::where('id_customer', $customerid)->first();

        if ($request->potongan_poin > $poin_customer->jumlah_poin) {
            return response()->json([
                'message' => 'Poin tidak cukup'
            ], 400);
        }

        $transaksi->potongan_poin = $request->potongan_poin;

        $transaksi->harga_pengurangan_poin = $request->harga_pengurangan_poin;
        $harga =  $request->harga_pengurangan_poin - ($request->potongan_poin * 100);

        $transaksi->id_customer = $customerid;
        $transaksi->id_packaging = $request->id_packaging;
        $transaksi->harga_total = $harga;
        $transaksi->save();

        return response()->json([
            'message' => 'Transaksi created successfully',
            'data' => $transaksi
        ]);
    }
}
