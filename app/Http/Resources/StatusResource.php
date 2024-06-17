<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JarakPengirimanResource extends JsonResource
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
            'id_jarak_pengiriman' => $this->id,
            'tanggal_ambil' => $this->tanggal_ambil,
            'tanggal_lunas' => $this->tanggal_lunas,
            'metode_pembayaran' => $this->metode_pembayaran,
            'status_pesanan' => $this->status_pesanan,
            'jenis_pengiriman' => $this->status_pengiriman,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
