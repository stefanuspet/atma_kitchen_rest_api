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

    //update
    public function update(Request $request, $id)
    {
        $gaji = Gaji::findOrFail($id);

        $request->validate([
            'honor_harian' => 'required',
            'bonus' => 'required',
        ]);

        // Perbarui data gaji dengan menyertakan id_user dan id_karyawan
        $gaji->update([
            'honor_harian' => $request->honor_harian,
            'bonus' => $request->bonus,
        ]);

        // return (new GajiResource($gaji))->setMessage('Gaji updated successfully');
        return response()->json([
            'message' => 'Gaji updated successfully',
            'data' => $gaji
        ]);
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
