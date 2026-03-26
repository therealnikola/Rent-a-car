<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Sve rute aplikacije
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


/*
|--------------------------------------------------------------------------
| JAVNI DEO
|--------------------------------------------------------------------------
*/

// početna strana – lista vozila
Route::get('/', [App\Http\Controllers\VehicleController::class, 'index'])
    ->name('welcome');

Route::get('/vehicle', [VehicleController::class, 'index'])
    ->name('vehicle.index');


// prikaz jedne sportske vozila
Route::get('/vehicle/{id}', [VehicleController::class, 'show'])
    ->name('vehicle.show');

// slanje zahteva za izdavanje (mora biti ulogovan)
Route::post('/vehicle/{id}/request', [VehicleController::class, 'sendRequest'])
    ->middleware('auth')
    ->name('vehicle.request');

    Route::delete('/home/vehicle/{id}', [HomeController::class, 'deleteVehicle'])
    ->name('home.deleteVehicle');

    Route::get('/my-rentals', [VehicleController::class, 'myRentals'])
    ->middleware('auth')
    ->name('user.rentals');




/*
|--------------------------------------------------------------------------
| AUTH (Laravel default)
|--------------------------------------------------------------------------
*/

Auth::routes();


/*
|--------------------------------------------------------------------------
| KORISNIČKI PANEL (ulogovani korisnik)
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (SAMO ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/home/new-vehicle', [HomeController::class, 'newVehicle'])
        ->name('home.newVehicle');

    Route::post('/home/store-vehicle', [HomeController::class, 'storeVehicle'])
        ->name('home.storeVehicle');

    Route::delete('/home/vehicle/{id}', [HomeController::class, 'deleteVehicle'])
        ->name('home.deleteVehicle');

    Route::get('/home/requests', [HomeController::class, 'requests'])
        ->name('home.requests');

    Route::get('/home/request/{id}/{status}', [HomeController::class, 'updateRequest'])
        ->name('home.updateRequest');
        
    Route::get('/home/vehicle/{id}/edit', [HomeController::class, 'editVehicle'])->name('home.editVehicle');
    Route::put('/home/vehicle/{id}/update', [HomeController::class, 'updateVehicle'])->name('home.updateVehicle');

});
