<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
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
            "id_produk" => $this->id,
            "nama_produk" => $this->nama_produk,
            "harga_satu_loyang" => $this->harga_satu_loyang,
            "harga_setengah_loyang" => $this->harga_setengah_loyang,
            "stok_produk" => $this->stok_produk,
            "image" => $this->image,
            "max_produksi" => $this->max_produksi,
            "id_user" => $this->id_user,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
