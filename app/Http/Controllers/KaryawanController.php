<?php

namespace App\Http\Controllers;

use App\Http\Resources\KaryawanGajiResource;
use App\Models\Karyawan;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    // this controller for api
    public function index()
    {
        return KaryawanGajiResource::collection(Karyawan::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|email',
            'notelp_karyawan' => 'required|min:10|max:13'
        ]);

        
        $Karyawan = Karyawan::create($validatedData);
        
        $dataGaji = [
            'bonus' => 0,
            'honor_harian' => 0,
            'id_karyawan' => $Karyawan->id,
            'id_user' => Auth::user()->id
        ];
    
        $Karyawan = Gaji::create($dataGaji);
        return (new KaryawanGajiResource($Karyawan))->setMessage('Karyawan created successfully');
    }

    public function update(Request $request, $id)
    {
        $Karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|email',
            'notelp_karyawan' => 'required|min:10|max:13'
        ]);

        $Karyawan->nama_karyawan = $request->nama_karyawan;
        $Karyawan->email_karyawan = $request->email_karyawan;
        $Karyawan->notelp_karyawan = $request->notelp_karyawan;
        $Karyawan->save();

        return (new KaryawanGajiResource($Karyawan))->setMessage('Karyawan updated successfully');
    }

    public function search()
    {
        $Karyawan = Karyawan::where('nama_karyawan', 'like', '%' . request('nama_karyawan') . '%')->get();
        return response()->json([
            'data' => $Karyawan
        ], 200);
    }

    public function show($id)
    {
        $Karyawan = Karyawan::findOrFail($id);
        return (new KaryawanGajiResource($Karyawan))->setMessage('Karyawan shown successfully');
    }

    public function destroy($id)
    {
        $Karyawan = Karyawan::findOrFail($id);
        $Karyawan->delete();

        return response()->json([
            'message' => 'Karyawan deleted successfully'
        ]);
    }
}
