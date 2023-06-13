<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FleetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $parrent = parent::toArray($request);
        return array_merge($parrent, [
            'engine' => $this->engine(),
            'cargo_data' => $this->cargo_data(),
        ]);
    }
}
