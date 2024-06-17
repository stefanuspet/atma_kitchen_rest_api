<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    //index
    public function index()
    {
        $presensis = Presensi::all();
        return response()->json([
            "presensis" => $presensis
        ]);
    }

    //store
    public function store(Request $request)
    {
        $presensi = new Presensi();
        $presensi->tanggal_presensi = $request->tanggal_presensi;
        $presensi->Status = $request->Status;
        $presensi->id_karyawan = $request->id_karyawan;
        $presensi->save();

        return response()->json([
            "message" => "Presensi berhasil ditambahkan",
            "presensi" => $presensi
        ]);
    }

    //update
    public function update(Request $request, $id)
    {
        $presensi = Presensi::find($id);
        $presensi->tanggal_presensi = $request->tanggal_presensi;
        $presensi->Status = $request->Status;
        $presensi->id_karyawan = $request->id_karyawan;
        $presensi->save();

        return response()->json([
            "message" => "Presensi berhasil diupdate",
            "presensi" => $presensi
        ]);
    }

    //destroy
    public function destroy($id)
    {
        $presensi = Presensi::find($id);
        $presensi->delete();

        return response()->json([
            "message" => "Presensi berhasil dihapus"
        ]);
    }

    //show
    public function show($id)
    {
        $presensi = Presensi::find($id);
        return response()->json([
            "presensi" => $presensi
        ]);
    }
}
