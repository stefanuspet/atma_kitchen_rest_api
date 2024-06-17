<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    //index
    public function index()
    {
        $jabatans = Jabatan::all();
        return response()->json([
            "jabatans" => $jabatans
        ]);
    }

    //show
    public function show($id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan) {
            return response()->json([
                "jabatan" => $jabatan
            ]);
        } else {
            return response()->json([
                "message" => "Jabatan not found"
            ], 404);
        }
    }

    //store
    public function store(Request $request)
    {
        $jabatan = new Jabatan();
        $jabatan->deskripsi_jabatan = $request->deskripsi_jabatan;
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->save();

        return response()->json([
            "message" => "Jabatan record created"
        ]);
    }

    //update
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan) {
            $jabatan->deskripsi_jabatan = $request->deskripsi_jabatan;
            $jabatan->nama_jabatan = $request->nama_jabatan;
            $jabatan->save();

            return response()->json([
                "message" => "Jabatan record updated"
            ]);
        } else {
            return response()->json([
                "message" => "Jabatan not found"
            ], 404);
        }
    }

    //destroy
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);
        if ($jabatan) {
            $jabatan->delete();
            return response()->json([
                "message" => "Jabatan record deleted"
            ]);
        } else {
            return response()->json([
                "message" => "Jabatan not found"
            ], 404);
        }
    }
}
