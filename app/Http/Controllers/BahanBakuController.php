<?php

namespace App\Http\Controllers;

use App\Http\Resources\BahanBakuResource;
use App\Models\Bahan_baku;
use Illuminate\Http\Request;

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
        $validatedData = $request->validate([
            'bahan_baku' => 'required',
            'jumlah_tersedia' => 'required',
            'satuan_bahan' => 'required',
            'harga_satuan' => 'required'
        ]);

        $bahan_baku = Bahan_baku::create($validatedData);

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
        $bahan_baku = Bahan_baku::findOrFail($id);

        $request->validate([
            'bahan_baku' => 'required',
            'jumlah_tersedia' => 'required',
            'satuan_bahan' => 'required',
            'harga_satuan' => 'required'
        ]);

        $bahan_baku->update($request->only(['bahan_baku', 'jumlah_tersedia', 'satuan_bahan', 'harga_satuan']));

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
        $produk = Bahan_baku::where('bahan_baku', 'like', '%' . request('bahan_baku') . '%')->get();
        return response()->json([
            'data' => $produk
        ], 200);
    }
}
