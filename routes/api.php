<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SkdrController;
use App\Http\Controllers\API\SmileController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/skdr', [SkdrController::class, 'getSkdr']);
Route::get('/smile', [SmileController::class, 'getSmile']);