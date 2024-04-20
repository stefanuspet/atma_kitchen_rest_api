<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenitipResource;
use App\Models\Penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenitipController extends Controller
{
    //controller for api
    public function index()
    {
        return PenitipResource::collection(Penitip::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_penitip' => 'required',
            'email_penitip' => 'required|email',
            'notelp_penitip' => 'required|min:10|max:13'
        ]);

        $penitip = Penitip::create($validatedData);

        return (new PenitipResource($penitip))->setMessage('Penitip created successfully');
    }

    public function show($id)
    {
        $penitip = Penitip::findOrFail($id);

        return (new PenitipResource($penitip))->setMessage('Penitip shown successfully');
    }


    public function update(Request $request, $id)
    {
        $penitip = Penitip::findOrFail($id);

        $request->validate([
            'nama_penitip' => 'required',
            'email_penitip' => 'required|email',
            'notelp_penitip' => 'required|min:10|max:13'
        ]);

        $penitip->update($request->only(['nama_penitip', 'email_penitip', 'notelp_penitip']));

        return (new PenitipResource($penitip))->setMessage('Penitip updated successfully');
    }


    public function destroy($id)
    {
        $penitip = Penitip::findOrFail($id);
        $penitip->delete();

        return response()->json([
            'message' => 'Penitip deleted successfully'
        ]);
    }
}
