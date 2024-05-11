<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahanBakuResource;
use App\Models\Bahan_baku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BahanBakuController extends Controller
{
    // index
    public function index()
    {
        return BahanBakuResource::collection(Bahan_baku::all());
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan_baku' => 'required',
            'jumlah_tersedia' => 'required',
            'satuan_bahan' => 'required',
            'harga_satuan' => 'required'
        ]);

        $user_id = Auth::user()->id;

        // $bahan_baku = Bahan_baku::create($validatedData);
        $bahan_baku = new Bahan_baku();
        $bahan_baku->nama_bahan_baku = $request->nama_bahan_baku;
        $bahan_baku->jumlah_tersedia = $request->jumlah_tersedia;
        $bahan_baku->satuan_bahan = $request->satuan_bahan;
        $bahan_baku->harga_satuan = $request->harga_satuan;
        $bahan_baku->id_user = $user_id;
        $bahan_baku->save();

        return (new BahanBakuResource($bahan_baku))->setMessage('Bahan baku created successfully');
    }

    // show
    public function show($id)
    {
        $bahan_baku = Bahan_baku::findOrFail($id);
        return (new BahanBakuResource($bahan_baku))->setMessage('Bahan baku shown successfully');
    }

    // update
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $bahan_baku = Bahan_baku::findOrFail($id);

        $request->validate([
            'nama_bahan_baku' => 'required',
            'jumlah_tersedia' => 'required',
            'satuan_bahan' => 'required',
            'harga_satuan' => 'required'
        ]);

        // $bahan_baku->update($request->only(['nama_bahan_baku', 'jumlah_tersedia', 'satuan_bahan', 'harga_satuan']));
        $bahan_baku->nama_bahan_baku = $request->nama_bahan_baku;
        $bahan_baku->jumlah_tersedia = $request->jumlah_tersedia;
        $bahan_baku->satuan_bahan = $request->satuan_bahan;
        $bahan_baku->harga_satuan = $request->harga_satuan;
        $bahan_baku->id_user = $user_id;
        $bahan_baku->save();

        return (new BahanBakuResource($bahan_baku))->setMessage('Bahan baku updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $bahan_baku = Bahan_baku::findOrFail($id);
        $bahan_baku->delete();

        return response()->json([
            'message' => 'Bahan baku deleted successfully'
        ]);
    }
    public function search()
    {
        $bahan_baku = Bahan_baku::where('nama_bahan_baku', 'like', '%' . request('nama_bahan_baku') . '%')->get();
        return response()->json([
            'data' => $bahan_baku
        ], 200);
    }
}
