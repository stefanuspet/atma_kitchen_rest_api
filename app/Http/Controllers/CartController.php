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

        $user_id = Auth::user()->id;
        $cart = new Cart();
        $cart->id_customer = $user_id;
        $cart->id_produk = $request->id_produk;
        $cart->id_produk_penitip = $request->id_produk_penitip;
        $cart->id_hampers = $request->id_hampers;
        $cart->jumlah_produk = $request->jumlah_produk;
        $cart->loyang = $request->loyang;

        // find produk
        $produk = Produk::find($request->id_produk);

        if ($request->id_produk) {
            if ($request->loyang == "satu") {
                $cart->total = $request->jumlah_produk * $produk->harga_satu_loyang;
            } else {
                $cart->total = $request->jumlah_produk * $produk->harga_setengah_loyang;
            }
        } else if ($request->id_produk_penitip) {
            $cart->total = $request->jumlah_produk * $request->produk_penitip->harga;
        } else if ($request->id_hampers) {
            $cart->total = $request->jumlah_produk * $request->hampers->harga;
        }
        $cart->save();
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
                if ($cart->loyang == "satu") {
                    $cart->total = $cart->jumlah_produk * $produk->harga_satu_loyang;
                } else {
                    $cart->total = $cart->jumlah_produk * $produk->harga_setengah_loyang;
                }
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
        return response()->json($cart);
    }
}
