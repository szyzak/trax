<?php

namespace App\Modules\Cars\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'trip_count' => $this->when(isset($this->trip_count), $this->trip_count),
            'trip_miles' => $this->when(isset($this->trip_miles), $this->trip_miles),
        ];
    }
}
