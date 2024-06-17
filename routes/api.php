<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\HampersController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PembelianBahanBakuController;
use App\Http\Controllers\PengeluaranLainController;
use App\Http\Controllers\PenitipController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukPenitipController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JarakPengirimanController;
use App\Http\Controllers\KonfirmasiPembayaranController;
use App\Http\Controllers\KoutaProduksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenarikanSaldoController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::post('/register', [AuthController::class, 'registerCustomer']);
Route::post('/customers/login', [AuthController::class, 'loginCustomer']);
Route::post('/users/login', [AuthController::class, 'loginUser']);
// login all
Route::post('/login', [AuthController::class, 'login']);
// forgot password User
Route::post('/users/forgetpassword', [UserController::class, 'forgetPassword']);
// forgot password Customer
Route::post('/customers/requestforget', [CustomerController::class, 'forgetPassword']);
// verify token
Route::post('/customers/verify/{token}', [CustomerController::class, 'verify']);
// ===============[ all User can access ] ===============
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk_penitip', [ProdukPenitipController::class, 'index']);
Route::get('/hampers', [HampersController::class, 'index']);


// ===============[ authenticated user ] ===============
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/customers/profile', [CustomerController::class, 'getProfile']);
    Route::post('/customers/profile/{id}', [CustomerController::class, 'update']);
    Route::get('/customers/history', [CustomerController::class, 'show']);
    Route::get('/users/profile', [UserController::class, 'getProfile']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'abilities:Customer'])->group(function () {
    Route::get('/produk_user/{id}', [ProdukController::class, 'show']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::put("/cart/{id}", [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);
    Route::get('/cart/{id}', [CartController::class, 'show']);
    Route::delete('/cart_produk/{id}', [CartController::class, 'destroyByProduk']);

    Route::post('/checkout', [TransaksiController::class, 'checkout']);
    Route::get('/transaksi_user', [TransaksiController::class, 'index']);

    // addproduktodetail
    Route::post('/addProdukToDetail/{id}', [TransaksiController::class, 'addProdukToDetail']);

    Route::get('/poin', [PoinController::class, 'index']);
    Route::put('/poin_user', [PoinController::class, 'update']);

    Route::get('/detail_transaksi', [DetailTransaksiController::class, 'getByIdTransaksi']);
    Route::get('/detail_transaksi_all', [DetailTransaksiController::class, 'getAllTransaksi']);

    // kuota produksi
    Route::get('/kuota_produksi', [KoutaProduksiController::class, 'index']);
    Route::get('/kuota_produksi/{id}', [KoutaProduksiController::class, 'show']);
    Route::post('/kuota_produksi/produk/{id}', [KoutaProduksiController::class, 'showByProduk']);
    Route::post('/kuota_produksi', [KoutaProduksiController::class, 'store']);
    Route::put('/kuota_produksi/{id}', [KoutaProduksiController::class, 'update']);
    Route::delete('/kuota_produksi/{id}', [KoutaProduksiController::class, 'destroy']);
    Route::get('/kuota_produksi/tanggal/{tanggal}', [KoutaProduksiController::class, 'showByTanggal']);
    Route::get('/transaksi_cus', [TransaksiController::class, 'index']);
    Route::get('/transaksi_cus/search/{id}', [TransaksiController::class, 'search']);
});

// ===============[ role : Admin ] ===============
Route::middleware(['auth:sanctum', 'abilities:ADMIN'])->group(function () {
    // produk
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::post('/produk/{id}', [ProdukController::class, 'update']);
    Route::get('/produk/{id}', [ProdukController::class, 'show']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);
    Route::get('/produk/search/{nama_produk}', [ProdukController::class, 'search']);

    // bahan baku
    Route::get('/bahanbaku', [BahanBakuController::class, 'index']);
    Route::post('/bahanbaku', [BahanBakuController::class, 'store']);
    Route::put('/bahanbaku/{id}', [BahanBakuController::class, 'update']);
    Route::get('/bahanbaku/{id}', [BahanBakuController::class, 'show']);
    Route::delete('/bahanbaku/{id}', [BahanBakuController::class, 'destroy']);
    Route::get('/bahanbaku/search/{bahan_baku}', [BahanBakuController::class, 'search']);

    // produk penitip
    Route::get('/penitip_search', [PenitipController::class, 'index']);
    Route::post('/produk_penitip', [ProdukPenitipController::class, 'store']);
    Route::post('/produk_penitip/{id}', [ProdukPenitipController::class, 'update']);
    Route::get('/produk_penitip/{id}', [ProdukPenitipController::class, 'show']);
    Route::delete('/produk_penitip/{id}', [ProdukPenitipController::class, 'destroy']);
    Route::get('/produk_penitip/search/{nama_produk_penitip}', [ProdukPenitipController::class, "search"]);

    // hampers
    Route::post('/hampers', [HampersController::class, 'store']);
    Route::put('/hampers/{id}', [HampersController::class, 'update']);
    Route::get('/hampers/{id}', [HampersController::class, 'show']);
    Route::delete('/hampers/{id}', [HampersController::class, 'destroy']);
    Route::get('/hampers/search/{nama_hampers}', [HampersController::class, 'search']);
    Route::post('/hampers/addproduk/{hampersId}', [HampersController::class, 'addProduct']);
    Route::delete('/hampers/{hampersId}/{produkId}', [HampersController::class, 'removeProduct']);

    // Poin
    Route::get('/poins', [PoinController::class, 'index']);
    Route::post('/poins', [PoinController::class, 'store']);
    Route::put('/poins/{id}', [PoinController::class, 'update']);
    Route::get('/poins/{id}', [PoinController::class, 'show']);
    Route::delete('/poins/{id}', [PoinController::class, 'destroy']);

    // resep
    Route::get('/produk_search', [ProdukController::class, 'index']);
    Route::get('/bahan_baku_search', [BahanBakuController::class, 'index']);
    Route::get('/resep', [ResepController::class, 'index']);
    Route::post('/resep', [ResepController::class, 'store']);
    Route::put('/resep/{id}', [ResepController::class, 'update']);
    Route::get('/resep/{id}', [ResepController::class, 'show']);
    Route::delete('/resep/{id}', [ResepController::class, 'destroy']);
    Route::get('/resep/search/{nama_produk}', [ProdukPenitipController::class, "search"]);

    // jarak pengiriman
    Route::get('/jarak_pengiriman', [JarakPengirimanController::class, 'index']);
    Route::post('/jarak_pengiriman', [JarakPengirimanController::class, 'store']);
    Route::put('/jarak_pengiriman/{id}', [JarakPengirimanController::class, 'update']);
    Route::get('/jarak_pengiriman/{id}', [JarakPengirimanController::class, 'show']);
    Route::delete('/jarak_pengiriman/{id}', [JarakPengirimanController::class, 'destroy']);

    // konfirmasi pembayaran
    Route::get('/konfirmasi_pembayaran', [KonfirmasiPembayaranController::class, 'index']);
    Route::post('/konfirmasi_pembayaran', [KonfirmasiPembayaranController::class, 'store']);
    Route::get('/konfirmasi_pembayaran/{id}', [KonfirmasiPembayaranController::class, 'show']);
    Route::post('/konfirmasi_pembayaran/{id}', [KonfirmasiPembayaranController::class, 'update']);
    Route::delete('/konfirmasi_pembayaran/{id}', [KonfirmasiPembayaranController::class, 'destroy']);
    Route::post('/konfirmasi-pembayaran/{id}/hitung-tip', [KonfirmasiPembayaranController::class, 'hitungTip']);

    // transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'updateJarak']);
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show']);

    Route::get('/statusTransaksi', [TransaksiController::class, 'getTransaksi']);
    Route::get('/statusTransaksi/{id}', [TransaksiController::class, 'getStatusById']);
    Route::put('/statusTransaksi/{id}', [TransaksiController::class, 'updateStatus']);

    Route::get('/sudahBayar', [KonfirmasiPembayaranController::class, 'getSudahBayar']);

    // Route::get('/transaksi/lunas', [TransaksiController::class, 'getTransaksiLunas']);

    // Route::get('/transaksi/pembatalan', [TransaksiController::class, 'getPembatalan']);
    // Route::put('/transaksi/batalkan/{id}', [TransaksiController::class, 'batalkanPembayaran']);

    // // pesanan
    // Route::get('/pesanan', [PesananController::class, 'index']);
    // Route::put('/pesanan/{id}/status', [PesananController::class, 'updateStatus']);

    // penarikan saldo
    Route::get('/penarikan_saldo', [PenarikanSaldoController::class, 'index']);
    Route::put('/penarikan_saldo/{id}', [PenarikanSaldoController::class, 'updateTrasfered']);
});

// ===============[  role : Manager ] ===============
Route::middleware(['auth:sanctum', 'abilities:MO'])->group(function () {
    // karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan', [KaryawanController::class, 'store']);
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
    Route::get('/karyawan/{id}', [KaryawanController::class, 'show']);
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy']);
    Route::get('/karyawan/search/{nama_karyawan}', [KaryawanController::class, 'search']);

    Route::get('/pengeluaranlain', [PengeluaranLainController::class, 'index']);
    Route::post('/pengeluaranlain', [PengeluaranLainController::class, 'store']);
    Route::put('/pengeluaranlain/{id}', [PengeluaranLainController::class, 'update']);
    Route::get('/pengeluaranlain/{id}', [PengeluaranLainController::class, 'show']);
    Route::delete('/pengeluaranlain/{id}', [PengeluaranLainController::class, 'destroy']);
    Route::get('/pengeuaranlain/search/{pengeluaran_lain}', [PengeluaranLainController::class, 'search']);

    // penitip
    Route::get('/penitip', [PenitipController::class, 'index']);
    Route::post('/penitip', [PenitipController::class, 'store']);
    Route::put('/penitip/{id}', [PenitipController::class, 'update']);
    Route::get('/penitip/{id}', [PenitipController::class, 'show']);
    Route::delete('/penitip/{id}', [PenitipController::class, 'destroy']);

    // presensi
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::post('/presensi', [PresensiController::class, 'store']);
    Route::put('/presensi/{id}', [PresensiController::class, 'update']);
    Route::get('/presensi/{id}', [PresensiController::class, 'show']);
    Route::delete('/presensi/{id}', [PresensiController::class, 'destroy']);

    // jabatan
    Route::get('/jabatan', [JabatanController::class, 'index']);
    Route::post('/jabatan', [JabatanController::class, 'store']);
    Route::put('/jabatan/{id}', [JabatanController::class, 'update']);
    Route::get('/jabatan/{id}', [JabatanController::class, 'show']);
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy']);

    //pembelian bahan baku
    Route::get('/pembelian_bahan_baku/bahanbaku', [BahanBakuController::class, 'index']);
    Route::get('/pembelian_bahan_baku/bahanbaku/{id}', [BahanBakuController::class, 'show']);
    Route::get('/pembelian_bahan_baku/{id}', [PembelianBahanBakuController::class, 'show']);
    Route::get('/pembelian_bahan_baku', [PembelianBahanBakuController::class, 'index']);
    Route::post('/pembelian_bahan_baku', [PembelianBahanBakuController::class, 'store']);
    Route::put('/pembelian_bahan_baku/{id}', [PembelianBahanBakuController::class, 'update']);
    Route::delete('/pembelian_bahan_baku/{id}', [PembelianBahanBakuController::class, 'destroy']);
    Route::post('/pembelian_bahan_baku/search', [PembelianBahanBakuController::class, 'getNamaBahanBaku']);

    Route::get('/cetak_laporan_bb_o', [BahanBakuController::class, 'laporanstok']);
    route::post('/cetak_laporan_bulanan_produk_mo', [TransaksiController::class, 'LaporanPenjualanBulanan']);

    // pesanan
    Route::get('/pesananhariini', [transaksiController::class, 'pesananHariIni']);
    Route::get('/laporan_penjualan_bulanan', [TransaksiController::class, 'laporanPenjualanBulanan']);
    Route::get('/laporan_penggunaan_bahan_baku', [BahanBakuController::class, 'laporanPenggunaanBahanBaku']);
});

// ===============[  role : Owner ] ===============

Route::middleware(['auth:sanctum', 'abilities:OWNER'])->group(function () {
    // gaji
    Route::get('/karyawan_search', [KaryawanController::class, 'index']);
    Route::get('/gaji', [GajiController::class, 'index']);
    // Route::post('/gaji', [GajiController::class, 'store']);
    Route::put('/gaji/{id}', [GajiController::class, 'update']);
    Route::get('/gaji/{id}', [GajiController::class, 'show']);
    Route::delete('/gaji/{id}', [GajiController::class, 'destroy']);

    Route::get('/cetak_laporan_bb_o', [BahanBakuController::class, 'laporanstok']);
    route::post('/cetak_laporan_bulanan_produk_Ow', [TransaksiController::class, 'LaporanPenjualanBulanan']);
    Route::get('/laporan_penjualan_bulanan', [TransaksiController::class, 'laporanPenjualanBulanan']);
    Route::get('/laporan_penggunaan_bahan_baku', [BahanBakuController::class, 'laporanPenggunaanBahanBaku']);
});

// laporan
Route::get('/laporan/presensi-dan-gaji-pegawai', [LaporanController::class, 'presensiGaji']);
Route::get('/laporan/pemasukan-dan-pengeluaran-bulanan/{month}/{year}', [LaporanController::class, 'pemasukanPengeluaran']);
Route::get('/laporan/rekap-transaksi-penitip/{month}/{year}', [LaporanController::class, 'rekapTransaksiPenitip']);
