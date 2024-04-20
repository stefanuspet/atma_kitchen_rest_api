<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProdukController extends Controller
{
    public function index()
    {
        return ProdukResource::collection(Produk::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|unique:produks',
            'harga_produk' => 'required',
            'stok_produk' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user_id = Auth::user()->id;

        $imageName = Str::uuid()->toString() . '.' . $request->file('image')->extension();
        $imagePath = $request->file('image')->storeAs('public/img_product', $imageName);
        $imageUrl = url(Storage::url($imagePath));

        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->stok_produk = $request->stok_produk;
        $produk->id_user = $user_id;
        $produk->image = $imageUrl;
        $produk->save();

        return (new ProdukResource($produk))->setMessage('Product created successfully');
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $produk = Produk::findOrFail($id);

        $request->validate([
            "nama_produk" => "required",
            "harga_produk" => "required",
            "stok_produk" => "required",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        if ($request->hasFile('image')) {
            $imagePath = 'public/img_product/' . basename($produk->image);
            Storage::delete($imagePath);
            $imageName = Str::uuid()->toString() . '.' . $request->file('image')->extension();
            $imagePath = $request->file('image')->storeAs('public/img_product', $imageName);
            $produk->image = url(Storage::url($imagePath));
        }

        $produk->nama_produk = $request->nama_produk;
        $produk->harga_produk = $request->harga_produk;
        $produk->stok_produk = $request->stok_produk;
        $produk->id_user = $user_id;

        $produk->save();

        return (new ProdukResource($produk))->setMessage('Product updated successfully');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return (new ProdukResource($produk))->setMessage('Product shown successfully');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $imagePath = 'public/img_product/' . basename($produk->image);
        Storage::delete($imagePath);
        $produk->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}
