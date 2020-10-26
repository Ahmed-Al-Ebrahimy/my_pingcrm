<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

// Patients
Route::get('patients', [PatientController::class, 'index'])->name('patients');

Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');

Route::post('patients', [PatientController::class, 'store'])->name('patients.store');

Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');

Route::put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');

Route::post('patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::put('patients/{patient}/restore', [PatientController::class, 'restore'])->name('patients.restore');


// Addresses
Route::get('addresses', [addressController::class, 'index'])->name('addresses')->middleware('auth');

Route::get('addresses/create', [addressController::class, 'create'])->name('addresses.create')->middleware('auth');

Route::post('addresses', [addressController::class, 'store'])->name('addresses.store')->middleware('auth');

Route::get('addresses/{address}/edit', [addressController::class, 'edit'])->name('addresses.edit')->middleware('auth');

Route::put('addresses/{address}', [addressController::class, 'update'])->name('addresses.update')->middleware('auth');

Route::post('addresses/{address}', [addressController::class, 'destroy'])->name('addresses.destroy')->middleware('auth');

// Route::put('addresses/{address}/restore', [addressController::class, 'restore'])->name('addresses.restore')->middleware('auth');
