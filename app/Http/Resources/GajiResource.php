<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GajiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    protected $message = '';

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
    public function toArray(Request $request): array
    {
        $response = [
            'id_gaji' => $this->id,
            'gaji_pokok' => $this->gaji_pokok,
            'tunjangan' => $this->tunjangan,
            'potongan' => $this->potongan,
            'total_gaji' => $this->total_gaji,
            'id_karyawan' => $this->id_karyawan,
        ];

        if ($this->message) {
            $response['message'] = $this->message;
        }

        return $response;
    }
}
