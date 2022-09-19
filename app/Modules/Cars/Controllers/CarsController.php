<?php

namespace App\Modules\Cars\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cars\FormRequests\CarFormRequest;
use App\Modules\Cars\Models\Car;
use App\Modules\Cars\Resources\CarResource;
use Symfony\Component\HttpFoundation\Response;

class CarsController extends Controller
{
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    public function show(int $carId)
    {
        /** @var Car $car */
        $car = Car::findOrFail($carId);
        $car->trip_count = $car->trips()->count();
        $car->trip_miles = round($car->trips()->sum('miles'), 2);

        return new CarResource($car);
    }

    public function store(CarFormRequest $request)
    {
        $car = new Car();
        $car->fill($request->validated());
        $car->save();

        return new CarResource($car);
    }

    public function destroy(int $carId)
    {
        /** @var Car $car */
        $car = Car::findOrFail($carId);
        $car->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
