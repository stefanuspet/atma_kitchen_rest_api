<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResepResource;
use App\Models\Resep;
use App\Models\Produk;
use App\Models\Bahan_baku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResepController extends Controller
{
    // index
    public function index()
    {
        // return ResepResource::collection(Resep::all());
        return response()->json([
            'data' => Resep::all()
        ]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'takaran' => 'required',
            'id_produk' => 'required',
            'id_bahan_baku' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $resep = new Resep();
        $resep->takaran = $request->takaran;
        $resep->id_produk = $request->id_produk;
        $resep->id_bahan_baku = $request->id_bahan_baku;
        $resep->id_user = $user_id;
        $resep->save();

        // return (new ResepResource($resep))->setMessage('Resep created successfully');
        return response()->json([
            'message' => 'Resep created successfully',
            'data' => $resep
        ]);
    }

    // show
    public function show($id)
    {
        $resep = Resep::findOrFail($id);

        // return (new ResepResource($resep))->setMessage('Resep shown successfully');
        return response()->json([
            'message' => 'Resep shown successfully',
            'data' => $resep
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $resep = Resep::findOrFail($id);

        $request->validate([
            'takaran' => 'required',
            'id_produk' => 'required',
            'id_bahan_baku' => 'required',
        ]);

        $resep->takaran = $request->takaran;
        $resep->id_produk = $request->id_produk;
        $resep->id_bahan_baku = $request->id_bahan_baku;
        $resep->id_user = $user_id;
        $resep->save();

        // return (new ResepResource($resep))->setMessage('Resep updated successfully');
        return response()->json([
            'message' => 'Resep updated successfully',
            'data' => $resep
        ]);
    }

    // destroy
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json([
            'message' => 'Resep deleted successfully'
        ]);
    }

    public function search()
    {
        $resep = Resep::where('takaran', 'like', '%' . request('takaran') . '%')->get();
        $id_produk = $resep->pluck("id_produk")->toArray();
        $produk = Produk::whereIn('id', $id_produk)->get()->keyBy('id');
        $id_bahan_baku = $resep->pluck("id_bahan_baku")->toArray();
        $bahan_baku = Bahan_baku::whereIn('id', $id_bahan_baku)->get()->keyBy('id');
        $resep->transform(function ($resep) use ($produk, $bahan_baku) {
            $resep->nama_produk = $produk[$resep->id_produk]->nama_produk;
            $resep->nama_bahan_baku = $bahan_baku[$resep->id_bahan_baku]->nama_bahan_baku;
            return $resep;
        });

        return response()->json([
            'data' => $resep
        ], 200);
    }
}
