<?php

namespace App\Http\Controllers;

use App\Http\Resources\GajiResource;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    //index
    public function index()
    {
        return GajiResource::collection(Gaji::all());
    }

    //show
    public function show($id)
    {
        $gaji = Gaji::findOrFail($id);
        return (new GajiResource($gaji))->setMessage('Gaji shown successfully');
    }

    //store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'honor_harian' => 'required',
            'bonus' => 'required',
            'total_gaji' => 'required',
            'tanggal_gaji' => 'required',
            'id_karyawan' => 'required'
        ]);

        $validatedData['id_user'] = Auth::user()->id;

        $gaji = Gaji::create($validatedData);

        return (new GajiResource($gaji))->setMessage('Gaji created successfully');
    }

    //update
    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        $request->validate([
            'honor_harian' => 'required',
            'bonus' => 'required',
            'total_gaji' => 'required',
            'tanggal_gaji' => 'required',
            'id_karyawan' => 'required'
        ]);

        // Perbarui data gaji dengan menyertakan id_user dan id_karyawan
        $gaji->update([
            'honor_harian' => $request->honor_harian,
            'bonus' => $request->bonus,
            'total_gaji' => $request->total_gaji,
            'tanggal_gaji' => $request->tanggal_gaji,
            'id_user' => Auth::user()->id,
            'id_karyawan' => $request->id_karyawan
        ]);

        return (new GajiResource($gaji))->setMessage('Gaji updated successfully');
    }


    //destroy
    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        return response()->json([
            'message' => 'Gaji deleted successfully'
        ]);
    }

    //showByKaryawan
    public function showByKaryawan($id_karyawan)
    {
        $gajis = Gaji::where("id_karyawan", $id_karyawan)->get();
        return response()->json([
            "gajis" => $gajis
        ]);
    }
}
