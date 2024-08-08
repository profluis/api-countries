<?php

use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/countries', [CountryController::class, 'list']);
Route::get('/states', [StateController::class, 'list']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
