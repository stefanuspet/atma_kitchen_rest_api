<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $message = '';

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function toArray(Request $request): array
    {
        $response = [
            'id_transaksi' => $this->id,
            'tanggal_transaksi' => $this->tanggal_transaksi,
            'metode_pembayaran' => $this->produk->metode_pembayaran,
            'bahan_baku' => $this->bahan_baku->nama_bahan_baku,
            'id_produk' => $this->id_produk,
            'id_bahan_baku' => $this->id_bahan_baku,
            'id_user' => $this->id_user,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
