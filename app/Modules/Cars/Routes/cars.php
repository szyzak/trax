<?php


use App\Modules\Cars\Controllers\CarsController;

Route::apiResource('cars', CarsController::class)->except(['update']);
