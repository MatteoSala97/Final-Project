<?php



use App\Http\Controllers\Api\AccomodationController;
use App\Http\Controllers\Api\UserAddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/accommodations', [AccomodationController::class, 'index']);
Route::get('/accommodations/{id}', [AccomodationController::class, 'show']);
Route::get('/get-address-suggestions', [UserAddressController::class, 'suggestAddressList']);
Route::get('/filtered-accommodations', [AccomodationController::class, 'filteredAccommodations']);
Route::get('get-api-key', function () {
    $api_key = env('TOMTOM_API_KEY');
    if ($api_key) {
        return response()->json([
            'success' => true,
            'key' => $api_key
        ]);
    } else {
        return response()->json([
            'success' => false,
            'error' => 'There was an error retrieving the api key'
        ]);
    }
});
