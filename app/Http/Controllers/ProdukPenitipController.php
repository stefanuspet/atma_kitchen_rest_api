<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailProdukPenitipResource;
use App\Http\Resources\ProdukPenitipResource;
use App\Models\Produk_penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukPenitipController extends Controller
{
    public function index()
    {
        return ProdukPenitipResource::collection(Produk_penitip::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk_penitip' => 'required',
            'harga_produk_penitip' => 'required',
            'stok_produk_penitip' => 'required',
            'gambar_produk_penitip' => 'required',
            'id_penitip' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $uploadFolder = "produk_penitip";
        $image = $request->file('gambar_produk_penitip');
        $image_upload_path = $image->store($uploadFolder, 'public');
        $uploadedImageResponse = basename($image_upload_path);


        // $imageName = Str::uuid()->toString() . '.' . $request->file('gambar_produk_penitip')->extension();
        // $imagePath = $request->file('gambar_produk_penitip')->storeAs('public/img_product', $imageName);
        // $imageUrl = url(Storage::url($imagePath));

        $produk_penitip = new Produk_penitip();
        $produk_penitip->nama_produk_penitip = $request->nama_produk_penitip;
        $produk_penitip->harga_produk_penitip = $request->harga_produk_penitip;
        $produk_penitip->stok_produk_penitip = $request->stok_produk_penitip;
        $produk_penitip->id_penitip = $request->id_penitip;
        $produk_penitip->id_user = $user_id;
        $produk_penitip->gambar_produk_penitip = $uploadedImageResponse;
        $produk_penitip->save();

        return (new DetailProdukPenitipResource($produk_penitip))->setMessage('Produk_penitip created successfully');
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $produk_penitip = Produk_penitip::findOrFail($id);

        $request->validate([
            "nama_produk_penitip" => "required",
            "harga_produk_penitip" => "required",
            "stok_produk_penitip" => "required",
            "gambar_produk_penitip" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            "id_penitip" => "required",
        ]);

        if ($request->hasFile('gambar_produk_penitip')) {
            // delete old image
            $oldImagePath = 'public/produk_penitip/' . basename($produk_penitip->gambar_produk_penitip);
            Storage::delete($oldImagePath);

            $uploadFolder = "produk_penitip";
            $image = $request->file('gambar_produk_penitip');
            $image_upload_path = $image->store($uploadFolder, 'public');
            $uploadedImageResponse = basename($image_upload_path);
            Storage::disk('public')->delete('produk_penitip/' . $produk_penitip->gambar_produk_penitip);


            $produk_penitip->gambar_produk_penitip = $uploadedImageResponse;
        } else {
            $img = $produk_penitip->gambar_produk_penitip;
            $produk_penitip->gambar_produk_penitip = $img;
        }


        $produk_penitip->nama_produk_penitip = $request->nama_produk_penitip;
        $produk_penitip->harga_produk_penitip = $request->harga_produk_penitip;
        $produk_penitip->stok_produk_penitip = $request->stok_produk_penitip;
        $produk_penitip->id_penitip = $request->id_penitip;
        $produk_penitip->id_user = $user_id;
        $produk_penitip->save();

        return (new ProdukPenitipResource($produk_penitip))->setMessage('Produk_penitip updated successfully');
    }

    public function show($id)
    {
        $produk_penitip = Produk_penitip::findOrFail($id);
        return (new ProdukPenitipResource($produk_penitip))->setMessage('Produk_penitip shown successfully');
    }

    public function destroy($id)
    {
        $produk_penitip = Produk_penitip::findOrFail($id);
        $imagePath = 'public/produk_penitip/' . basename($produk_penitip->gambar_produk_penitip);
        Storage::delete($imagePath);
        $produk_penitip->delete();
        return response()->json(['message' => 'Produk_penitip deleted successfully']);
    }
}
