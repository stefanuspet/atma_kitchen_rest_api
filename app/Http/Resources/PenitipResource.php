<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenitipResource extends JsonResource
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
            "id_penitip" => $this->id,
            "nama_penitip" => $this->nama_penitip,
            "email_penitip" => $this->email_penitip,
            "notelp_penitip" => $this->notelp_penitip,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }


        return $response;
    }
}
