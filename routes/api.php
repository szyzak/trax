<?php

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')
    ->group(__DIR__ . '/../app/Modules/Cars/Routes/cars.php');

Route::middleware('auth:api')
    ->group(__DIR__ . '/../app/Modules/Trips/Routes/trips.php');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
