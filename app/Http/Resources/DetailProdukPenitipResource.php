<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailProdukPenitipResource extends JsonResource
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
            'data' => [
                'id_produk_penitip' => $this->id,
                'nama_produk' => $this->nama_produk_penitip,
                'harga_produk' => $this->harga_produk_penitip,
                'stok_produk' => $this->stok_produk_penitip,
                'gambar_produk' => $this->gambar_produk_penitip,
                'id_penitip' => $this->id_penitip,
                "nama_penitip" => $this->penitip->nama_penitip,
            ]
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
