<?php

namespace App\Modules\Trips\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cars\Models\Car;
use App\Modules\Trips\FormRequests\TripFormRequest;
use App\Modules\Trips\Models\Trip;
use App\Modules\Trips\Resources\TripResource;
use Illuminate\Support\Facades\DB;

class TripsController extends Controller
{
    public function index()
    {
        $carColumns = ($dummyCarModel = new Car())->getFillable();
        $carColumns[] = $dummyCarModel->getKeyName();
        $prefixedCarColumns = array_map(
            fn($column) => "cars.$column as car_$column" ,$carColumns
        );

        $trips = DB::table('trips')
            ->join('cars', 'trips.car_id', '=', 'cars.id')
            ->where('trips.user_id', '=', auth()->user()->id)
            ->select('trips.*', ...$prefixedCarColumns)
            ->addSelect('trips.date as main_trip_date')
            ->selectSub(
                DB::table('trips')
                    ->whereRaw('date <= main_trip_date')
                    ->selectRaw("SUM(miles)")
            , 'total')
            ->get();

        return TripResource::collection($trips);
    }


    public function store(TripFormRequest $request)
    {
        $trip = new Trip();
        $trip->fill($request->validated());
        $trip->save();

        return new TripResource($trip);
    }
}
