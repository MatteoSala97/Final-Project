<?php

use App\Http\Controllers\AccomodationController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use App\Models\Accomodation;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// add welcome page
Route::get('/', function () {
    if (auth()->check()) {
        $user = User::findOrFail(auth()->id());
        $accomodations = Accomodation::where('user_id', auth()->id())->get();
        return view('pages.accomodation.index', compact('user', 'accomodations'));
    } else {
        return view('auth.login');
    }
});


Route::get('/dashboard', function () {
    $user = User::findOrFail(auth()->id());
    $accomodations = Accomodation::where('user_id', auth()->id())->get();
    return view('dashboard', compact('user', 'accomodations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    // localhost:8000/dashboard/accomodations
    Route::resource('accomodations', AccomodationController::class);

    // routes per confermare la cancellazione del cosino
    Route::get('/accomodations/{accomodation}/delete-confirmation', [AccomodationController::class, 'destroyConfirmation'])->name('accomodations.destroyConfirmation');
    Route::delete('/accomodations/{accomodation}/delete-confirmed', [AccomodationController::class, 'deleteConfirmed'])->name('accomodations.deleteConfirmed');

});


require __DIR__ . '/auth.php';
