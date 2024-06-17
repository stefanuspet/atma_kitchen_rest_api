<?php

namespace App\Http\Controllers;

use App\Models\Poin;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    // index
    public function index()
    {
        $poins = Poin::all();
        return response()->json([
            "poins" => $poins
        ]);
    }

    // store
    public function store(Request $request)
    {
        $request->validate([
            'jumlah_poin' => 'required',
            'id_customer' => 'required'
        ]);

        // Buat dan simpan data poin
        $poin = Poin::create([
            'jumlah_poin' => $request->jumlah_poin,
            'id_customer' => $request->id_customer
        ]);

        return response()->json([
            'message' => 'Poin berhasil ditambahkan',
            'poin' => $poin
        ]);
    }


    // update
    public function update(Request $request, $id)
    {
        $poin = Poin::findOrFail($id);
        $request->validate([
            'jumlah_poin' => 'required',
            'id_customer' => 'required'
        ]);

        $poin->jumlah_poin = $request->jumlah_poin;
        $poin->id_customer = $request->id_customer;
        $poin->save();

        return response()->json([
            'message' => 'Poin berhasil diupdate',
            'poin' => $poin
        ]);
    }

    // show
    public function show($id)
    {
        $poin = Poin::findOrFail($id);
        return response()->json([
            'poin' => $poin
        ]);
    }

    // destroy
    public function destroy($id)
    {
        $poin = Poin::findOrFail($id);
        $poin->delete();

        return response()->json([
            "message" => "Poin berhasil dihapus"
        ]);
    }
}
