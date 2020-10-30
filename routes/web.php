<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EducationlevelController;

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

Route::get('/design_test', function () {
    return Inertia\Inertia::render('design_test');
})->name('design_test');

// Educationlevels
Route::get('educationlevels', [EducationlevelController::class, 'index'])->name('educationlevels')->middleware('auth');
Route::get('educationlevels/create', [EducationlevelController::class, 'create'])->name('educationlevels.create')->middleware('auth');
Route::post('educationlevels', [EducationlevelController::class, 'store'])->name('educationlevels.store')->middleware('auth');
Route::get('educationlevels/{educationlevel}/edit', [EducationlevelController::class, 'edit'])->name('educationlevels.edit')->middleware('auth');
Route::put('educationlevels/{educationlevel}', [EducationlevelController::class, 'update'])->name('educationlevels.update')->middleware('auth');
Route::post('educationlevels/{educationlevel}', [EducationlevelController::class, 'destroy'])->name('educationlevels.destroy')->middleware('auth');
Route::put('educationlevels/{educationlevel}/restore', [EducationlevelController::class, 'restore'])->name('educationlevels.restore')->middleware('auth');

// Patients
Route::middleware(['auth:sanctum', 'verified'])->get('patients', [PatientController::class, 'index'])->name('patients');

Route::middleware(['auth:sanctum', 'verified'])->get('patients/create', [PatientController::class, 'create'])->name('patients.create');

Route::middleware(['auth:sanctum', 'verified'])->post('patients', [PatientController::class, 'store'])->name('patients.store');

Route::middleware(['auth:sanctum', 'verified'])->get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');

Route::middleware(['auth:sanctum', 'verified'])->put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');

Route::middleware(['auth:sanctum', 'verified'])->post('patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');

Route::middleware(['auth:sanctum', 'verified'])->put('patients/{patient}/restore', [PatientController::class, 'restore'])->name('patients.restore');


// Addresses
Route::get('addresses', [addressController::class, 'index'])->name('addresses')->middleware('auth');
Route::get('addresses/create', [addressController::class, 'create'])->name('addresses.create')->middleware('auth');
Route::post('addresses', [addressController::class, 'store'])->name('addresses.store')->middleware('auth');
Route::get('addresses/{address}/edit', [addressController::class, 'edit'])->name('addresses.edit')->middleware('auth');
Route::put('addresses/{address}', [addressController::class, 'update'])->name('addresses.update')->middleware('auth');
Route::post('addresses/{address}', [addressController::class, 'destroy'])->name('addresses.destroy')->middleware('auth');
Route::put('addresses/{address}/restore', [addressController::class, 'restore'])->name('addresses.restore')->middleware('auth');
