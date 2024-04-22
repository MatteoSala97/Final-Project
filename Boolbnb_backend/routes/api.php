<?php

use App\Http\Controllers\Api\AccomodationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AccomodationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

<<<<<<< HEAD
Route::get('/accomodations', [AccomodationController::class, 'index']);
=======
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/accommodations', [AccomodationController::class, 'index']);
>>>>>>> 0d27d1e3873ea31bd69e69baddea127242d66561
