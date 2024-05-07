<?php

namespace App\Http\Controllers;

use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KaryawanController extends Controller
{
    // this controller for api
    public function index()
    {
        return KaryawanResource::collection(Karyawan::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|email',
            'notelp_karyawan' => 'required|min:10|max:13'
        ]);

        $Karyawan = Karyawan::create($validatedData);

        return (new KaryawanResource($Karyawan))->setMessage('Karyawan created successfully');
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

        // $Karyawan = Karyawan::update($validatedData);

        return (new KaryawanResource($Karyawan))->setMessage('Karyawan updated successfully');
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

        return (new KaryawanResource($Karyawan))->setMessage('Karyawan shown successfully');
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
