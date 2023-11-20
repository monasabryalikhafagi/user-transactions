<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'      => (int) $this->id,
            'email'   => (string) $this->email,
            'name'    => (string) $this->name ?? '',
            'currency'   => (string) $this->currency,
            'balance'  => (string) $this->balance,
        ];
    }
}
