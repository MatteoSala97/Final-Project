<?php



use App\Http\Controllers\Api\AccomodationController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ViewController;
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

Route::post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ['token' => $token->plainTextToken];
});

// Route::middleware('auth:sanctum')->get('/sanctum/csrf-cookie', function (Request $request) {
//     return response()->json(['csrf_token' => csrf_token()]);
// });

Route::get('/accommodations', [AccomodationController::class, 'index']);
Route::get('/accommodations/{id}', [AccomodationController::class, 'show']);
Route::get('/get-address-suggestions', [UserAddressController::class, 'suggestAddressList']);
Route::get('/filtered-accommodations', [AccomodationController::class, 'filteredAccommodations']);
Route::post('/send-message', [MessageController::class, 'store']);
Route::post('/store-visual', [ViewController::class, 'store']);

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout']);



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

// http://127.0.0.1:8000/api/contacts}
Route::post('/contacts', [LeadController::class, 'store']);

// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
 
//     return ['token' => $token->plainTextToken];
// });
