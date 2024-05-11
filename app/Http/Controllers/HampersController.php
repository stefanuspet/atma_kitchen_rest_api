<?php

namespace App\Http\Controllers;

use App\Http\Resources\HampersResource;
use App\Models\Hampers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HampersController extends Controller
{
    //controller for api
    public function index()
    {
        // return HampersResource::collection(Hampers::all());
        $hampersWithProducts = Hampers::with('produk')->get();
        $formattedData = [];
        foreach ($hampersWithProducts as $hampers) {
            $formattedData[] = [
                'id' => $hampers->id,
                'nama_hampers' => $hampers->nama_hampers,
                'harga_hampers' => $hampers->harga_hampers,
                'deskripsi_hampers' => $hampers->deskripsi_hampers,
                'tanggal_pembuatan_hampers' => $hampers->tanggal_pembuatan_hampers,
                'stok_hampers' => $hampers->stok_hampers,
                'id_user' => $hampers->id_user,
                'created_at' => $hampers->created_at,
                'updated_at' => $hampers->updated_at,
                'produk' => $hampers->produk->map(function ($produk) {
                    return [
                        'id' => $produk->id,
                        'nama_produk' => $produk->nama_produk,
                        'harga_produk' => $produk->harga_produk,
                        'stok_produk' => $produk->stok_produk,
                        'image' => $produk->image,
                        'id_user' => $produk->id_user,
                        'created_at' => $produk->created_at,
                        'updated_at' => $produk->updated_at,
                        'pivot' => [
                            'hampers_id' => $produk->pivot->hampers_id,
                            'produk_id' => $produk->pivot->produk_id,
                            // 'stok_hampers' => $produk->pivot->stok_hampers,
                        ],
                    ];
                }),
            ];
        }

        return response()->json(['data' => $formattedData]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hampers' => 'required',
            'harga_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'tanggal_pembuatan_hampers' => 'required',
            'stok_hampers' => 'required',
        ]);
        $user_id = Auth::user()->id;

        $hampers = new Hampers();
        $hampers->nama_hampers = $request->nama_hampers;
        $hampers->harga_hampers = $request->harga_hampers;
        $hampers->deskripsi_hampers = $request->deskripsi_hampers;
        $hampers->tanggal_pembuatan_hampers = $request->tanggal_pembuatan_hampers;
        $hampers->stok_hampers = $request->stok_hampers;
        $hampers->id_user = $user_id;

        $hampers->save();

        return (new HampersResource($hampers))->setMessage('Hampers created successfully');
    }

    public function show($id)
    {
        $hampers = Hampers::with('produk')->findOrFail($id);

        $formattedData = [
            'id' => $hampers->id,
            'nama_hampers' => $hampers->nama_hampers,
            'harga_hampers' => $hampers->harga_hampers,
            'deskripsi_hampers' => $hampers->deskripsi_hampers,
            'tanggal_pembuatan_hampers' => $hampers->tanggal_pembuatan_hampers,
            'stok_hampers' => $hampers->stok_hampers,   
            'id_user' => $hampers->id_user,
            'created_at' => $hampers->created_at,
            'updated_at' => $hampers->updated_at,
            'produk' => $hampers->produk->map(function ($produk) {
                return [
                    'id' => $produk->id,
                    'nama_produk' => $produk->nama_produk,
                    'harga_produk' => $produk->harga_produk,
                    'stok_produk' => $produk->stok_produk,
                    'image' => $produk->image,
                    'id_user' => $produk->id_user,
                    'created_at' => $produk->created_at,
                    'updated_at' => $produk->updated_at,
                    'pivot' => [
                        'hampers_id' => $produk->pivot->hampers_id,
                        'produk_id' => $produk->pivot->produk_id,
                        'stok_hampers' => $produk->pivot->stok_hampers,
                    ],
                ];
            }),
        ];

        return response()->json(['data' => $formattedData]);
    }

    public function update(Request $request, $id)
    {
        $hampers = Hampers::findOrFail($id);

        $request->validate([
            'nama_hampers' => 'required',
            'harga_hampers' => 'required',
            'deskripsi_hampers' => 'required',
            'tanggal_pembuatan_hampers' => 'required',
            'stok_hampers' => 'required',
        ]);

        $hampers->update([
            'nama_hampers' => $request->nama_hampers,
            'harga_hampers' => $request->harga_hampers,
            'deskripsi_hampers' => $request->deskripsi_hampers,
            'tanggal_pembuatan_hampers' => $request->tanggal_pembuatan_hampers,
            'stok_hampers' => $request->stok_hampers,
            'id_user' => Auth::user()->id,
        ]);

        return (new HampersResource($hampers))->setMessage('Hampers updated successfully');
    }


    public function destroy($id)
    {
        $hampers = Hampers::findOrFail($id);
        $hampers->delete();

        return response()->json([
            'message' => 'Hampers deleted successfully'
        ]);
    }

    public function search()
    {
        $hampers = Hampers::where('nama_hampers', 'like', '%' . request('nama_hampers') . '%')->get();
        return response()->json([
            'data' => $hampers
        ], 200);
    }

    // add product to hampers
    // public function addProduct($id, Request $request)
    // {
    //     $hampers = Hampers::findOrFail($id);
    //     $hampers->products()->attach($request->product_id, ['jumlah' => $request->jumlah]);
    //     return (new HampersResource($hampers))->setMessage('Product added to hampers successfully');
    // }

    public function addProduct(Request $request, $hampersId)
    {
        $hampers = Hampers::findOrFail($hampersId);

        $request->validate([
            'id_produk' => 'required|exists:produks,id',
        ]);

        // Attach Product to Hampers
        $hampers->produk()->attach($request->id_produk);

        return response()->json(['message' => 'Produk berhasil ditambahkan ke dalam Hampers'], 200);
    }

    public function gethampersall()
    {
        $hampersWithProducts = Hampers::with('produk')->get();
        return response()->json($hampersWithProducts);
    }

    // delete product from hampers
    public function removeProduct($hampersId, $productId)
    {
        // Temukan hampers berdasarkan ID
        $hampers = Hampers::findOrFail($hampersId);

        // Detach produk berdasarkan ID
        $hampers->produk()->detach($productId);

        return response()->json(['message' => 'Produk berhasil dihapus dari Hampers'], 200);
    }
}
