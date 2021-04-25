<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['data' => [
            'id' => $this->id,
            'name' => $this->name,
            'rate' => $this->rate,
            'date' => $this->date,
        ]];
    }
}
