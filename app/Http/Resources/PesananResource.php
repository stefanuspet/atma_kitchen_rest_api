<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PesananResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    protected $message = "";

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function toArray(Request $request): array
    {
        $response = [
            'id_pesanan' => $this->id,
            'nama_produk' => $this->nama_produk,
            'jarak' => $this->jarak,
            'harga' => $this->harga,
            'waktu' => $this->waktu,
            'id_transaksi' => $this->id_transaksi,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        // Include transaction details if available
        if ($this->transaksi) {
            $response['transaksi'] = [
                'id' => $this->transaksi->id,
                'tanggal_transaksi' => $this->transaksi->tanggal_transaksi,
                'metode_pembayaran' => $this->transaksi->metode_pembayaran,
                'status_pesanan' => $this->transaksi->status_pesanan,
                'jenis_pengiriman' => $this->transaksi->jenis_pengiriman,
                'harga_total' => $this->transaksi->harga_total,
            ];
        }

        return $response;
    }
}
