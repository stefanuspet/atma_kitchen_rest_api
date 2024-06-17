<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PengeluaranLainResource extends JsonResource
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
            'id_pengeluaran_lain' => $this->id,
            'nama_pengeluaran' => $this->nama_pengeluaran,
            'total_pengeluaran' => $this->total_pengeluaran,
            'tanggal_pengeluaran' => $this->tanggal_pengeluaran,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
