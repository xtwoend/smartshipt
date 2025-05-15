<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FleetDashboardResource extends JsonResource
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
        return $parrent;
        // return array_merge($parrent, [
            // 'engine' => $this->engine(),
            // 'engine_info' => $this->engine()?->information(),
            // 'cargo_data' => $this->cargo(),
            // 'cargo_pump' => $this->cargo_pump(),
            // 'fuel' => $this->fuel(),
            // 'ballast' => $this->ballast(),
            // 'draft' => $this->draft(),
            // 'cargo_pump_info' => $this->cargo_pump()?->information(),
        // ]);
    }
}
