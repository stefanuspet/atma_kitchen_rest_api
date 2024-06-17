<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PembelianBahanBakuResource extends JsonResource
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
            "id_pembelian_bahan_baku" => $this->id,
            "jumlah_bahan_baku" => $this->jumlah_bahan_baku,
            "total_harga" => $this->total_harga,
            "tanggal_pembelian" => $this->tanggal_pembelian,
            "id_user" => $this->id_user,
            "id_bahan_baku" => $this->id_bahan_baku,
            "nama_bahan_baku" => $this->bahan_baku->nama_bahan_baku,
            "jumlah_tersedia_bahanbaku" => $this->bahan_baku->jumlah_tersedia,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
