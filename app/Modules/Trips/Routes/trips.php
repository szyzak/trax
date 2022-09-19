<?php


use App\Modules\Trips\Controllers\TripsController;
use Illuminate\Support\Facades\Route;

Route::apiResource('trips', TripsController::class)
    ->only(['index', 'store']);
