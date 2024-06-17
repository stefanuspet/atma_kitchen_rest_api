<?php

namespace App\Http\Controllers;

use App\Models\Detail_transaksi;
use App\Models\Hampers;
use App\Models\Poin;
use App\Models\Produk;
use App\Models\Produk_penitip;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    // index
    public function index()
    {
        $transaksis = Transaksi::all();
        return response()->json([
            'data' => $transaksis
        ]);
    }

    public function checkout(Request $request)
    {
        // validation
        $request->validate([
            'tanggal_ambil' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengiriman' => 'required',
            'potongan_poin' => 'required|numeric|min:0',
            'harga_total' => 'required|numeric|min:0',
        ]);

        $transaksi = new Transaksi();
        $transaksi->tanggal_transaksi = date('Y-m-d H:i');
        $transaksi->tanggal_ambil = $request->tanggal_ambil;
        $transaksi->metode_pembayaran = $request->metode_pembayaran;
        $transaksi->status_pembayaran = "Belum Dibayar";
        $transaksi->status_pengiriman = $request->status_pengiriman;
        $transaksi->jenis_pengiriman = $request->jenis_pengiriman;
        $transaksi->tip = $request->tip;
        $transaksi->ongkir = $request->ongkir;
        $customerid = Auth::user()->id;
        // get jumlah_poin customer
        $poin_customer = Poin::where('id_customer', $customerid)->first();

        if ($request->potongan_poin > $poin_customer->jumlah_poin) {
            return response()->json([
                'message' => 'Poin tidak cukup'
            ], 400);
        }

        $transaksi->potongan_poin = $request->potongan_poin;

        $transaksi->harga_setelah_poin = ($request->potongan_poin * 100);
        $harga =  $transaksi->harga_setelah_poin;

        $transaksi->id_customer = $customerid;
        $transaksi->id_packaging = $request->id_packaging;
        $transaksi->harga_total = $request->harga_total - $harga;
        $transaksi->save();

        // get id transaksi last insert
        $transaksi = Transaksi::latest()->first();

        return response()->json([
            'message' => 'Transaksi created successfully',
            'data' => $transaksi
        ]);
    }

    // add produk/hampers/penitip to transaksi
    public function addProdukToDetail(Request $request, $id)
    {
        // validation
        $request->validate([
            'id_produk' => 'required',
        ]);

        $transaksi = Transaksi::find($id);
        $transaksi->produk()->attach($request->id_produk);

        return response()->json([
            'message' => 'Produk added to transaksi successfully',
            'data' => $transaksi
        ]);
    }

    public function updateJarak(Request $request, $id)
    {
        // validation
        $request->validate([
            'jarak' => 'required',
        ]);

        $transaksi = Transaksi::find($id);
        $transaksi->jarak = $request->jarak;
        // if jarak < 5 = 10000 , 5 - 10 = 15000, 10 - 15 = 20000, > 15 = 25000
        if ($request->jarak < 5) {
            $transaksi->ongkir = 10000;
        } elseif ($request->jarak >= 5 && $request->jarak < 10) {
            $transaksi->ongkir = 15000;
        } elseif ($request->jarak >= 10 && $request->jarak < 15) {
            $transaksi->ongkir = 20000;
        } else {
            $transaksi->ongkir = 25000;
        }
        $transaksi->harga_total += $transaksi->ongkir;
        $transaksi->save();

        return response()->json([
            'message' => 'Transaksi updated successfully',
            'data' => $transaksi
        ]);
    }

    // get transaksi by id
    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            return response()->json([
                'data' => $transaksi
            ]);
        }
        return response()->json([
            'message' => 'Transaksi not found'
        ], 404);
    }

    public function getTransaksi()
    {
        $statuses = ['Sudah Dibayar', 'Siap di Pick-Up', 'Sudah di Pick-Up', 'Sedang Dikirim'];
        $transaksi = Transaksi::whereIn('status_pesanan', $statuses)->get();
        return response()->json($transaksi);
    }

    public function getStatusById($id)
    {
        $statuses = ['Sudah Dibayar', 'Siap di Pick-Up', 'Sudah di Pick-Up', 'Sedang Dikirim'];
        $transaksi = Transaksi::where('id', $id)->whereIn('status_pesanan', $statuses)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found or not in specified statuses'], 404);
        }

        return response()->json($transaksi);
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'status_pesanan' => 'required|string',
    //     ]);

    //     $transaksi = Transaksi::find($id);

    //     if ($transaksi) {
    //         $transaksi->status_pesanan = $validatedData['status_pesanan'];
    //         $transaksi->save();

    //         return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Failed to update status'], 400);
    // }

    public function updateStatus(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status_pesanan' => 'required|string',
        ]);

        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi not found'], 404);
        }

        $transaksi->status_pesanan = $validatedData['status_pesanan'];

        if ($request->status_pesanan === 'Selesai') {
            $transaksi->delete();
            return response()->json([
                'message' => 'Transaksi selesai and deleted successfully',
                'data' => null
            ]);
        } else {
            $transaksi->save();
            return response()->json([
                'message' => 'Transaksi updated successfully',
                'data' => $transaksi
            ]);
        }
    }

    public function LaporanPenjualanBulanan(Request $request)
    {
        // get transaksi where status_pesanan = Selesai and tanggal_ambil =  Request bulan&tahun
        $transaksis = Transaksi::where('status_pesanan', 'Selesai')
            ->whereMonth('tanggal_ambil', $request->bulan)
            ->whereYear('tanggal_ambil', $request->tahun)
            ->get();

        // get detail transaksi sesuai dengan $transaksi->id
        // foreach $transaksi->id
        foreach ($transaksis as $transaksi) {
            $detail_transaksi = Detail_transaksi::where('id_transaksi', $transaksi->id)->get();
            $transaksi->detail_transaksi = $detail_transaksi;
        }

        // add produk by id_produk from detail transaksi
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->detail_transaksi as $detail) {
                $produk = Produk::find($detail->id_produk);
                $detail->produk = $produk;
            }
        }

        $produkList = [];

        // get total kuantitas produk by id_produk
        foreach ($transaksis as $transaksi) {
            foreach ($transaksi->detail_transaksi as $detail) {
                $produk = Produk::find($detail->id_produk);
                // Check if the product already exists in the list
                if (isset($produkList[$produk->nama_produk])) {
                    $produkList[$produk->nama_produk]['jumlah_produk'] += $detail->jumlah_produk;
                    $produkList[$produk->nama_produk]['jumlah_uang'] += $detail->jumlah_produk * $produk->harga;
                } else {

                    $produkList[$produk->nama_produk] = [
                        'nama_produk' => $produk->nama_produk,
                        'jumlah_produk' => $detail->jumlah_produk,
                        'harga_produk' => $produk->harga,
                        "jumlah_uang" => $detail->jumlah_produk * $produk->harga
                    ];
                }
            }
        }

        // Convert associative array to indexed array
        $produkall = array_values($produkList);

        return response()->json([
            'data' => $produkall
        ]);
    }

    // menampilkan status pesanan diterima
    public function pesananHariIni()
    {
        $data = [];
        // Mendapatkan tanggal sekarang
        $now = Carbon::now();

        // Mendapatkan tanggal 1 hari setelah hari ini sebagai string tanggal
        $oneDayLater = $now->copy()->addDay()->toDateString();

        // Mengambil semua transaksi dengan status 'Diterima' dan tanggal_ambil lebih dari 1 hari dari sekarang
        $transaksis = Transaksi::with('customer')
            ->where('status_pesanan', 'Diterima')
            ->where('tanggal_ambil', '=', $oneDayLater)
            ->get();

        $formattedTransaksis = $transaksis->map(function ($transaksi) {
            $formattedDate = Carbon::parse($transaksi->tanggal_ambil)->format('y.m');
            $transaksi->no_nota = $formattedDate . '.' . $transaksi->id;
            return $transaksi;
        });

        // serach detail transaksi by id transaksi
        foreach ($formattedTransaksis as $transaksi) {
            $detail_transaksi = Detail_transaksi::where('id_transaksi', $transaksi->id)->get();
            $transaksi->detail_transaksi = $detail_transaksi;
        }

        // get produk by id_produk from detail transaksi
        foreach ($formattedTransaksis as $transaksi) {
            foreach ($transaksi->detail_transaksi as $detail) {
                $produk = Produk::find($detail->id_produk);
                $detail->produk = $produk;

                $data[] = [
                    'id' => $transaksi->id,
                    'no_nota' => $transaksi->no_nota,
                    'nama_customer' => $transaksi->customer->nama_customer,
                    'tanggal_ambil' => $transaksi->tanggal_ambil,
                    'jam_ambil' => $transaksi->jam_ambil,
                    'status_pesanan' => $transaksi->status_pesanan,
                    'produk' => [
                        'id' => $produk->id,
                        'nama_produk' => $produk->nama_produk,
                        'harga' => $produk->harga,
                        'jumlah_produk' => $detail->jumlah_produk
                    ]
                ];
            }
        }

        // insert data produk to $data
        foreach ($formattedTransaksis as $transaksi) {
            foreach ($transaksi->detail_transaksi as $detail) {
                $produk = Produk::find($detail->id_produk);
                $detail->produk = $produk;
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    // New method to get only "Sudah Dibayar" transactions
    public function getSudahBayar()
    {
        // Ensure correct status is used for filtering
        $transaksis = Transaksi::where('status_pesanan', 'Sudah Dibayar')->get();

        if ($transaksis->isEmpty()) {
            return response()->json(['message' => 'No transactions found'], 404);
        }

        return response()->json([
            'data' => $transaksis
        ]);
    }
}
