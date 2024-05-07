<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResepResource;
use App\Models\Resep;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    // index
    public function index()
    {
        return ResepResource::collection(Resep::all());
    }

    // store
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'takaran' => 'required'
        ]);

        $resep = Resep::create($validatedData);

        return (new ResepResource($resep))->setMessage('Resep created successfully');
    }

    // show
    public function show($id)
    {
        $resep = Resep::findOrFail($id);

        return (new ResepResource($resep))->setMessage('Resep shown successfully');
    }

    // update
    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        $request->validate([
            'takaran' => 'required'
        ]);

        $resep->update($request->only(['takaran']));

        return (new ResepResource($resep))->setMessage('Resep updated successfully');
    }

    // destroy
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        $resep->delete();

        return response()->json([
            'message' => 'Resep deleted successfully'
        ]);
    }
}
