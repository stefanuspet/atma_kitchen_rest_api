<?php

namespace App\Http\Controllers;

use App\Http\Resources\HampersResource;
use App\Models\Hampers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HampersController extends Controller
{
    //controller for api
    public function index()
    {
        return HampersResource::collection(Hampers::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hampers' => 'required',
            'harga_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'tanggal_pembuatan_hampers' => 'required',
            'stok_hampers' => 'required',
        ]);
        $user_id = Auth::user()->id;

        $hampers = new Hampers();
        $hampers->nama_hampers = $request->nama_hampers;
        $hampers->harga_hampers = $request->harga_hampers;
        $hampers->deskripsi_hampers = $request->deskripsi_hampers;
        $hampers->tanggal_pembuatan_hampers = $request->tanggal_pembuatan_hampers;
        $hampers->stok_hampers = $request->stok_hampers;
        $hampers->id_user = $user_id;

        $hampers->save();

        return (new HampersResource($hampers))->setMessage('Hampers created successfully');
    }

    public function show($id)
    {
        $hampers = Hampers::findOrFail($id);
        return (new HampersResource($hampers))->setMessage('Hampers shown successfully');
    }

    public function update(Request $request, $id)
    {
        $hampers = Hampers::findOrFail($id);

        $request->validate([
            'nama_hampers' => 'required',
            'harga_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'tanggal_pembuatan_hampers' => 'required',
            'stok_hampers' => 'required',
        ]);

        $hampers->update([
            'nama_hampers' => $request->nama_hampers,
            'harga_hampers' => $request->harga_hampers,
            'deskripsi_hampers' => $request->deskripsi_hampers,
            'tanggal_pembuatan_hampers' => $request->tanggal_pembuatan_hampers,
            'stok_hampers' => $request->stok_hampers,
            'id_user' => Auth::user()->id,
        ]);

        return (new HampersResource($hampers))->setMessage('Hampers updated successfully');
    }


    public function destroy($id)
    {
        $hampers = Hampers::findOrFail($id);
        $hampers->delete();

        return response()->json([
            'message' => 'Hampers deleted successfully'
        ]);
    }
}
