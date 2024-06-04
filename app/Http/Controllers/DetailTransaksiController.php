<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiController extends Controller
{
    // get by id transaksi
    // public function getByIdTransaksi()
    // {
    //     // gettransaksibyid user
    //     $userid = Auth::user()->id;
    //     $transaksi = Transaksi::where('id_user', $userid)->first();

    //     $detailTransaksi = Detail_transaksi::where('id_transaksi', $id)->get();
    //     $data = [];
    //     foreach ($detailTransaksi as $detail) {
    //         $produk = Produk::find($detail->id_produk);
    //         $transaksi = Transaksi::find($detail->id_transaksi);
    //         $data[] = [
    //             'id_transaksi' => $detail->id_transaksi,
    //             'id_produk' => $detail->id_produk,
    //             'jumlah' => $detail->jumlah,
    //             'harga' => $detail->harga,
    //             'subtotal' => $detail->subtotal,
    //             'created_at' => $detail->created_at,
    //             'updated_at' => $detail->updated_at,
    //             'produk' => $produk,
    //             "transaksi" => $transaksi
    //         ];
    //     }
    //     return response()->json($data);
    // }

    // get all transasksi by id user
    public function getAllTransaksi()
    {
        $userid = Auth::user()->id;
        $transaksi = Transaksi::where('id_customer', $userid)->get();
        $data = [];
        // $data = $transaksi;

        foreach ($transaksi as $trans) {
            $detailTransaksi = Detail_transaksi::where('id_transaksi', $trans->id)->get();
            $dataDetail = [];

            foreach ($detailTransaksi as $detail) {
                $produk = Produk::find($detail->id_produk);

                $dataDetail[] = [
                    'id_transaksi' => $detail->id_transaksi,
                    'id_produk' => $detail->id_produk,
                    'jumlah' => $detail->jumlah,
                    'harga' => $detail->harga,
                    'subtotal' => $detail->subtotal,
                    'created_at' => $detail->created_at,
                    'updated_at' => $detail->updated_at,
                    'produk' => $produk
                ];
            }

            $data[] = [
                'id' => $trans->id,
                'id_customer' => $trans->id_customer,
                'trans_total' => $trans->harga_total,
                'trans_status' => $trans->status,
                'trnas_tanggal_ambil' => $trans->tanggal_ambil,
                'trnas_tanggal_lunas' => $trans->tanggal_lunas,
                'trnas_tanggal_transaksi' => $trans->tanggal_transaksi,
                'created_at' => $trans->created_at,
                'updated_at' => $trans->updated_at,
                'detail_transaksi' => $dataDetail
            ];
        }

        return response()->json($data);
    }
}
