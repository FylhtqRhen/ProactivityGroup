<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'errors' => [
                [
                    'message' => $this->message,
                    'code' => $this->code,
                ]
            ]
        ];
    }

    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->code);
    }
}
