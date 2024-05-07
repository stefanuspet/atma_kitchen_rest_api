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
            'id_resep' => $this->id,
            'takaran' => $this->takaran,
            'id_produk' => $this->id_produk,
            'id_bahan_baku' => $this->id_bahan_baku,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
