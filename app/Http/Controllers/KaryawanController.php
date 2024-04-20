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
            'no_telp_karyawan' => 'required|min:10|max:13'
        ]);

        $Karyawan = Karyawan::create($validatedData);

        return (new KaryawanResource($Karyawan))->setMessage('Karyawan created successfully');
    }

    public function show($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        return (new KaryawanResource($karyawan))->setMessage('Karyawan shown successfully');
    }

    public function update(Request $request, $id)
    {
        $Karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama_karyawan' => 'required',
            'email_karyawan' => 'required|email',
            'no_telp_karyawan' => 'required|min:10|max:13'
        ]);

        $Karyawan->update($request->only(['nama_karyawan', 'email_karyawan', 'no_telp_karyawan']));

        return (new KaryawanResource($Karyawan))->setMessage('Karyawan updated successfully');
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
