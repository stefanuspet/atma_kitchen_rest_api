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
            'jarak' => $this->jarakPengiriman->jarak,
            'harga' => $this->jarakPengiriman->harga,
            'waktu' => $this->jarakPengiriman->waktu,
            'id_jarak_pengiriman' => $this->id_jarak_pengiriman,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
