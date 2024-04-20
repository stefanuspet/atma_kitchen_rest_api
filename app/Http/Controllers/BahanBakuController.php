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
            'nama_bahan_baku' => 'required',
            'stok_bahan_baku' => 'required',
            'satuan_bahan_baku' => 'required',
            'harga_bahan_baku' => 'required'
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
            'nama_bahan_baku' => 'required',
            'stok_bahan_baku' => 'required',
            'satuan_bahan_baku' => 'required',
            'harga_bahan_baku' => 'required'
        ]);

        $bahan_baku->update($request->only(['nama_bahan_baku', 'stok_bahan_baku', 'satuan_bahan_baku', 'harga_bahan_baku']));

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
}
