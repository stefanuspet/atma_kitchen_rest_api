<?php

namespace App\Http\Controllers;

use App\Models\KuotaProduksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class KoutaProduksiController extends Controller
{
    //
    public function index()
    {
        $kuota_produksi = KuotaProduksi::all();
        return response()->json($kuota_produksi);
    }

    public function show($id)
    {
        $kuota_produksi = KuotaProduksi::find($id);
        return response()->json($kuota_produksi);
    }

    public function showByProduk($id, Request $request)
    {
        $kuota_produksi = KuotaProduksi::where('id_produk', $id)->where('tanggal', $request->tanggal)->first();
        return response()->json([
            'data' => $kuota_produksi,
        ]);
    }

    public function showByTanggal($tanggal)
    {
        $kuota_produksi = KuotaProduksi::where('tanggal', $tanggal)->get();
        return response()->json($kuota_produksi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required',
            'tanggal' => 'required',
        ]);

        $kuota_produksi = new KuotaProduksi();
        $kuota_produksi->id_produk = $request->id_produk;

        // get produk by id
        $produk = Produk::find($request->id_produk);

        $kuota_produksi->max_produksi = $produk->max_produksi;
        $kuota_produksi->tanggal = $request->tanggal;
        $kuota_produksi->save();

        return response()->json($kuota_produksi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_produk' => 'required',
            "max_produksi" => "required",
        ]);

        $kuota_produksi = KuotaProduksi::find($id);
        $kuota_produksi->id_produk = $request->id_produk;

        // get produk by id
        $produk = Produk::find($request->id_produk);

        $kuota_produksi->max_produksi = $request->max_produksi;
        $kuota_produksi->save();

        return response()->json($kuota_produksi);
    }
}
