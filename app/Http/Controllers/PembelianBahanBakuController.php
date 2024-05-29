<?php

namespace App\Http\Controllers;

use App\Http\Resources\PembelianBahanBakuResource;
use App\Models\Bahan_baku;
use App\Models\Pembelian_bahan_baku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembelianBahanBakuController extends Controller
{
    //index
    public function index()
    {
        return PembelianBahanBakuResource::collection(Pembelian_bahan_baku::all());
    }

    //store
    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        $request->validate([
            'jumlah_bahan_baku' => 'required',
            'total_harga' => 'required',
            'tanggal_pembelian' => 'required',
            'id_bahan_baku' => 'required'
        ]);

        $request['id_user'] = $id_user;
        $BahanBaku = Bahan_baku::find($request->id_bahan_baku);
        $BahanBaku->jumlah_tersedia += $request->jumlah_bahan_baku;
        $BahanBaku->save();

        return (new PembelianBahanBakuResource(Pembelian_bahan_baku::create($request->all())))
            ->setMessage('Pembelian bahan baku created successfully');
    }

    //update
    public function update(Request $request,  $id)
    {
        $pembelian_bahan_baku = Pembelian_bahan_baku::findOrFail($id);
        $request->validate([
            'jumlah_bahan_baku' => 'required',
            'total_harga' => 'required',
            'tanggal_pembelian' => 'required',
            'id_bahan_baku' => 'required'
        ]);

        $BahanBaku = Bahan_baku::find($pembelian_bahan_baku->id_bahan_baku);
        $BahanBaku->jumlah_tersedia -= $pembelian_bahan_baku->jumlah_bahan_baku;
        $BahanBaku->jumlah_tersedia += $request->jumlah_bahan_baku;
        $BahanBaku->save();

        $pembelian_bahan_baku->update($request->all());

        return (new PembelianBahanBakuResource($pembelian_bahan_baku))
            ->setMessage('Pembelian bahan baku updated successfully');
    }

    //destroy
    public function destroy($id)
    {
        $pembelian_bahan_baku = Pembelian_bahan_baku::findOrFail($id);
        $BahanBaku = Bahan_baku::find($pembelian_bahan_baku->id_bahan_baku);
        $BahanBaku->jumlah_tersedia -= $pembelian_bahan_baku->jumlah_bahan_baku;
        $BahanBaku->save();
        $pembelian_bahan_baku->delete();

        return response()->json(['message' => 'Pembelian bahan baku deleted successfully']);
    }

    // search
    public function getNamaBahanBaku(Request $request)
    {
        // Validasi request
        $request->validate([
            'nama_bahan_baku' => 'required|string',
        ]);

        // Lakukan query untuk mencari nama bahan baku yang mirip
        $namaBahanBaku = DB::table('pembelian_bahan_bakus')
            ->join('bahan_bakus', 'pembelian_bahan_bakus.id_bahan_baku', '=', 'bahan_bakus.id')
            ->select('bahan_bakus.nama_bahan_baku')
            ->where('bahan_bakus.nama_bahan_baku', 'LIKE', '%' . $request->input('nama_bahan_baku') . '%')
            ->distinct()
            ->get();

        if ($namaBahanBaku->isNotEmpty()) {
            // Jika ada bahan baku yang mirip, kembalikan respons JSON dengan daftar bahan baku
            return response()->json(['bahan_baku' => $namaBahanBaku]);
        } else {
            // Jika tidak ditemukan, kembalikan response JSON dengan pesan error
            return response()->json(['error' => 'Bahan baku tidak ditemukan.'], 404);
        }
    }

    // show
    public function show($id)
    {
        $pembelian_bahan_baku = Pembelian_bahan_baku::findOrFail($id);
        return (new PembelianBahanBakuResource($pembelian_bahan_baku))->setMessage('Pembelian bahan baku shown successfully');
    }
}
