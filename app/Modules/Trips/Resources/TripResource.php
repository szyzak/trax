<?php

namespace App\Modules\Trips\Resources;

use App\Modules\Cars\Models\Car;
use App\Modules\Cars\Resources\CarResource;
use App\Modules\Trips\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    protected $model = Trip::class;

    public function toArray($request): array
    {
        $car = $this->usedBuilder()
            ? (new Car())->forceFill([
                'id' => $this->car_id,
                'make' => $this->car_make,
                'model' => $this->car_model,
                'year' => $this->car_year
            ])
            : $this->car;


        return [
            'id' => $this->id,
            'date' => Carbon::parse($this->date)->format('m/d/Y'),
            'miles' => $this->miles,
            'total' => $this->total,
            'car' => new CarResource($car)
        ];
    }

    /**
     * Detect whether query was performed on raw builder or eloquent model.
     *
     * @return bool
     */
    protected function usedBuilder(): bool
    {
        return !isset($this->car);
    }
}
