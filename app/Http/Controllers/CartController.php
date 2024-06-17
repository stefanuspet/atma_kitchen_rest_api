<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Hampers;
use App\Models\Produk;
use App\Models\Produk_penitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('id_customer', Auth::user()->id)->get();

        // if cart is empty
        if ($cart->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        // find produk
        foreach ($cart as $c) {
            if ($c->id_produk) {
                $c->produk = Produk::find($c->id_produk);
            } else if ($c->id_produk_penitip) {
                $c->produk_penitip = Produk_penitip::find($c->id_produk_penitip);
            } else if ($c->id_hampers) {
                $c->hampers = Hampers::find($c->id_hampers);
            }
        }

        $data = [
            'cart' => $cart,
            'produk' => $c->produk,
            'produk_penitip' => $c->produk_penitip,
            'hampers' => $c->hampers,
        ];
        return  response()->json($data);
    }

    // store cart
    public function store(Request $request)
    {
        $idcustomer = Auth::user()->id;

        $validatedData = $request->validate([
            'id_produk' => 'nullable|exists:produks,id',
            'id_hampers' => 'nullable|exists:hampers,id',
            'id_produk_penitip' => 'nullable|exists:produk_penitips,id',
            'jumlah_produk' => 'required|integer|min:1',
        ]);

        // Jika hanya produk yang ditambahkan
        if ($request->has('id_produk')) {
            $produk = Produk::find($validatedData['id_produk']);
            // Pengecekan loyang hanya berlaku untuk produk
            if ($produk) {
                // Jika loyang = "satu", gunakan harga_satu_loyang
                // Jika loyang = "setengah", gunakan harga_setengah_loyang
                // $hargaProduk = ($validatedData['loyang'] == 'satu') ? $produk->harga_satu_loyang : $produk->harga_setengah_loyang;
                $validatedData['total'] = $validatedData['jumlah_produk'] * $produk->harga;
            }
        }

        // Pencarian item dalam cart berdasarkan id_customer, id_produk, id_hampers, id_produk_penitip, dan loyang
        $cartItem = Cart::where('id_customer', $idcustomer)
            ->where(function ($query) use ($validatedData) {
                $query->where('id_produk', $validatedData['id_produk']);
                if (isset($validatedData['id_hampers'])) {
                    $query->orWhere('id_hampers', $validatedData['id_hampers']);
                }
                if (isset($validatedData['id_produk_penitip'])) {
                    $query->orWhere('id_produk_penitip', $validatedData['id_produk_penitip']);
                }
            })
            // ->where('loyang', $validatedData['loyang'])
            ->first();

        if ($cartItem) {
            // Jika item sudah ada dan loyang sama, tambahkan jumlah_produk
            $cartItem->jumlah_produk += $validatedData['jumlah_produk'];
            $cartItem->total += $validatedData['total'];
            $cartItem->save();
        } else {
            // Jika item tidak ada, buat yang baru
            Cart::create([
                'id_customer' => $idcustomer,
                'id_produk' => $validatedData['id_produk'],
                'id_hampers' => isset($validatedData['id_hampers']) ? $validatedData['id_hampers'] : null,
                'id_produk_penitip' => isset($validatedData['id_produk_penitip']) ? $validatedData['id_produk_penitip'] : null,
                'jumlah_produk' => $validatedData['jumlah_produk'],
                // 'loyang' => $validatedData['loyang'],
                'total' => $validatedData['total'],
            ]);
        }

        return response()->json([
            'message' => 'Item added to cart successfully',
            "data" => $validatedData,

        ], 200);
    }


    // detele cart by id produk
    public function destroyByProduk($id)
    {
        $cart = Cart::where('id_produk', $id)->delete();
        return response()->json($cart);
    }

    // delete cart
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json($cart);
    }

    // update cart
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->jumlah_produk = $request->jumlah_produk;
        $produk = Produk::find($cart->id_produk);

        if ($produk) {
            if ($cart->id_produk) {
                // if ($cart->loyang == "satu") {
                //     $cart->total = $cart->jumlah_produk * $produk->harga_satu_loyang;
                // } else {
                //     $cart->total = $cart->jumlah_produk * $produk->harga_setengah_loyang;
                // }
                $cart->total = $cart->jumlah_produk * $produk->harga;
            } else if ($request->id_produk_penitip) {
                $cart->total = $request->jumlah_produk * $request->produk_penitip->harga;
            } else if ($request->id_hampers) {
                $cart->total = $request->jumlah_produk * $request->hampers->harga;
            } else {
                // Handle cases where no matching id is provided
                return response()->json(['error' => 'Invalid product or category'], 400);
            }
        } else {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cart->save();
        return response()->json($cart);
    }

    //get chart by id
    public function show($id)
    {
        // if fail send message fail
        $cart = Cart::findOrFail($id);
        $data = [];

        if ($cart->id_produk) {
            $produk = Produk::find($cart->id_produk);
            $data['produk_id'] = $produk->id;
        } else if ($cart->id_produk_penitip) {
            $produk_penitip = Produk_penitip::find($cart->id_produk_penitip);
            $data['produk_penitip_id'] = $produk_penitip->id;
        } else if ($cart->id_hampers) {
            $hampers = Hampers::find($cart->id_hampers);
            $data['hampers_id'] = $hampers->id;
        }

        $data['loyang'] = $cart->loyang;
        $data['jumlah_produk'] = $cart->jumlah_produk;

        return response()->json($data);
    }
}
