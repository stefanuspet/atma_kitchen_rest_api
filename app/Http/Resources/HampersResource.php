<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HampersResource extends JsonResource
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
            "id_hampers" => $this->id,
            "nama_hampers" => $this->nama_hampers,
            "harga_hampers" => $this->harga_hampers,
            "deskripsi_hampers" => $this->deskripsi_hampers,
            "tanggal_pembuatan_hampers" => $this->tanggal_pembuatan_hampers,
            "stok_hampers" => $this->stok_hampers,
            "id_user" => $this->id_user,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
