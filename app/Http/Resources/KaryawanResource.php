<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KaryawanResource extends JsonResource
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
            "id_karyawan" => $this->id,
            "nama_karyawan" => $this->nama_karyawan,
            "email_karyawan" => $this->email_karyawan,
            "notelp_karyawan" => $this->notelp_karyawan,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
