<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenarikanSaldoResource extends JsonResource
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
      'id' => $this->id,
      'jumlah_penarikan' => $this->jumlah_penarikan,
      'tanggal_penarikan' => $this->tanggal_penarikan,
      'trasfered' => $this->trasfered,
    ];

    if ($this->message) {
      $response['message'] = $this->message;
    }

    return $response;
  }
}
