<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\GuestDaerahController;
use App\Http\Controllers\GuestController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/demo', function () {
    // If you want real "guest" access validation you can add logic here
    return redirect()->route('user.dashboard'); 
})->name('demo');

    // Guest public routes
    Route::get('/guest/daerah', [GuestDaerahController::class, 'index'])->name('guest.daerah');
    Route::get('/guest/dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('dashboard');

    // Kriteria CRUD
    Route::resource('kriteria', KriteriaController::class)->except(['show']);

    // Daerah CRUD
    Route::resource('daerah', DaerahController::class)->except(['show']);
    
    // Input Nilai Daerah
    Route::get('/daerah/{daerah}/nilai', [DaerahController::class, 'nilai'])->name('daerah.nilai');
    Route::post('/daerah/{daerah}/nilai', [DaerahController::class, 'nilaiStoreOrUpdate'])->name('daerah.nilai.store');

    // Bobot
    Route::get('/bobot', [BobotController::class, 'index'])->name('bobot.index');
    Route::post('/bobot', [BobotController::class, 'update'])->name('bobot.update');
});

// User Routes
// User Routes - accessible for Demo/Guest too, but might need checks inside controller if we want to hide sensitive data
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'indexUser'])->name('dashboard');

    // Analisis
    Route::get('/analisis', [PerhitunganController::class, 'index'])->name('analisis.index');
    Route::post('/analisis/proses', [PerhitunganController::class, 'proses'])->name('analisis.proses');
    Route::get('/analisis/detail/{daerah_id}', [PerhitunganController::class, 'detail'])->name('analisis.detail');
});
