<?php

namespace App\Http\Controllers;

use App\Models\Poin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function update(Request $request)
    {
        //search poin by id user
        $poin = Poin::where('id_customer', Auth::user()->id)->first();

        $request->validate([
            'jumlah_poin' => 'required',
        ]);

        $poin->jumlah_poin = $request->jumlah_poin;
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

    // get poin by customer id
    public function getPoinByCustomerId()
    {
        $customer_id = Auth::user()->id;
        $poin = Poin::where('id_customer', $customer_id)->first();
        return response()->json([
            'poin' => $poin
        ]);
    }
}
