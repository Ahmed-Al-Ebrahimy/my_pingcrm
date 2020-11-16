<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\EducationlevelController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\QueueController;

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

// // Resource Route for posts.
// Route::resource('posts', PostController::class);
// // Route for get posts for yajra post request.
// Route::get('get-posts', [PostController::class, 'getPosts'])->name('get-posts');

// Queue
Route::get('queue', [QueueController::class, 'index'])->name('queue')->middleware('auth');

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


// Tests
Route::get('tests', [TestController::class, 'index'])->name('tests')->middleware('auth');
Route::get('tests/create', [TestController::class, 'create'])->name('tests.create')->middleware('auth');
Route::post('tests', [TestController::class, 'store'])->name('tests.store')->middleware('auth');
Route::get('tests/{test}/edit', [TestController::class, 'edit'])->name('tests.edit')->middleware('auth');
Route::put('tests/{test}', [TestController::class, 'update'])->name('tests.update')->middleware('auth');
Route::post('tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy')->middleware('auth');
Route::put('tests/{test}/restore', [TestController::class, 'restore'])->name('tests.restore')->middleware('auth');

// Laboratory
Route::get('laboratory', [LaboratoryController::class, 'index'])->name('laboratory')->middleware('auth');


Route::get('laboratory/create', [LaboratoryController::class, 'create'])->name('laboratory.create')->middleware('auth');
Route::post('laboratory', [LaboratoryController::class, 'store'])->name('laboratory.store')->middleware('auth');


Route::get('laboratory/{patient}/edit', [LaboratoryController::class, 'edit'])->name('laboratory.edit')->middleware('auth');

Route::put('laboratory/{patient}', [LaboratoryController::class, 'update'])->name('laboratory.update')->middleware('auth');

// Route::post('laboratory/{patient}', [LaboratoryController::class, 'destroy'])->name('laboratory.destroy')->middleware('auth');



// Route::post('/app/attach_tests/{patient_id}', 'MyController@attachTests');
//     //Attach_tests routes
//     //Route::post('/attach_tests', 'TestVisitController@attachTests');
//     Route::post('/detach_tests', 'TestVisitController@detachTests');
//     Route::post('/sync_tests',   'TestVisitController@syncTests');

