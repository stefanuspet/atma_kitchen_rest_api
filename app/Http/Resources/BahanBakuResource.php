<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BahanBakuResource extends JsonResource
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
            'id_bahan_baku' => $this->id,
            'nama_bahan_baku' => $this->nama_bahan_baku,
            'jumlah_tersedia' => $this->jumlah_tersedia,
            'satuan_bahan' => $this->satuan_bahan,
            'harga_satuan' => $this->harga_satuan,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
