<?php

namespace App\Http\Controllers;

use App\Http\Resources\PengeluaranLainResource;
use App\Models\Pengeluaran_lain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranLainController extends Controller
{
    public function index()
    {
        return PengeluaranLainResource::collection(Pengeluaran_lain::all());
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'nama_pengeluaran' => 'required',
            'total_pengeluaran' => 'required',
            "tanggal_pengeluaran" => "required"
        ]);

        $user_id = Auth::user()->id;

        // $pengeluaran_lain = Pengeluaran_lain::create($validatedData);
        $pengeluaran_lain = new Pengeluaran_lain();
        $pengeluaran_lain->nama_pengeluaran = $request->nama_pengeluaran;
        $pengeluaran_lain->total_pengeluaran = $request->total_pengeluaran;
        $pengeluaran_lain->tanggal_pengeluaran = $request->tanggal_pengeluaran;
        $pengeluaran_lain->id_user = $user_id;
        $pengeluaran_lain->save();

        return (new PengeluaranLainResource($pengeluaran_lain))->setMessage('Pengeluaran Lain created successfully');
    }

    // show
    public function show($id)
    {
        $pengeluaran_lain = Pengeluaran_lain::findOrFail($id);
        return (new PengeluaranLainResource($pengeluaran_lain))->setMessage('Pengeluaran Lain shown successfully');
    }

    public function update(Request $request, $id)
    {
        $pengeluaran_lain = Pengeluaran_lain::findOrFail($id);

        $request->validate([
            'nama_pengeluaran' => 'required',
            'total_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required'
        ]);

        $pengeluaran_lain->update($request->only(['nama_pengeluaran', 'total_pengeluaran', 'tanggal_pengeluaran']));

        return (new PengeluaranLainResource($pengeluaran_lain))->setMessage('Pengeluaran Lain updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $pengeluaran_lain = Pengeluaran_lain::findOrFail($id);
        $pengeluaran_lain->delete();

        return response()->json([
            'message' => 'Pengeluaran Lain deleted successfully'
        ]);
    }
    // public function search()
    // {
    //     $pengeluaran_lain = Pengeluaran_lain::where('nama_pengeluaran', 'like', '%' . request('nama_pengeluaran') . '%')->get();
    //     return response()->json([
    //         'data' => $pengeluaran_lain
    //     ], 200);
    // }
    public function search($id)
    {
        $pengeluaran_lain = Pengeluaran_lain::findOrFail($id);
        $pengeluaran_lain->delete();

        return response()->json([
            'message' => 'Pengeluaran lain deleted successfully'
        ]);
    }
}
