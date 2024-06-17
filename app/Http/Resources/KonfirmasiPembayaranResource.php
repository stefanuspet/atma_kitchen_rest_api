<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KonfirmasiPembayaranResource extends JsonResource
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
            'id_konfirmasi_pembayaran' => $this->id,
            'harga' => $this->harga,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
