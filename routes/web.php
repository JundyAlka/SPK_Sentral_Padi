<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BobotController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PenilaianController;
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

    // Guest public routes removed

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
    Route::resource('kriteria', KriteriaController::class)->parameters([
        'kriteria' => 'kriteria'
    ])->except(['show']);

    // Daerah CRUD
    Route::resource('daerah', DaerahController::class)->parameters([
        'daerah' => 'daerah'
    ])->except(['show']);
    
    // Input Nilai Daerah - OLD (Keep strictly for compat or redirect)
    Route::get('/daerah/{daerah}/nilai', [DaerahController::class, 'nilai'])->name('daerah.nilai');
    Route::post('/daerah/{daerah}/nilai', [DaerahController::class, 'nilaiStoreOrUpdate'])->name('daerah.nilai.store');

    // Data Penilaian - NEW
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('/penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update');

    // Bobot
    Route::get('/bobot', [BobotController::class, 'index'])->name('bobot.index');
    Route::post('/bobot', [BobotController::class, 'update'])->name('bobot.update');

    // Perhitungan & Hasil Akhir
    Route::get('/perhitungan', [PerhitunganController::class, 'dataPerhitungan'])->name('perhitungan.index');
    Route::get('/hasil', [PerhitunganController::class, 'dataHasilAkhir'])->name('hasil.index');

    // User Management
    Route::resource('user', \App\Http\Controllers\UserController::class)->parameters([
        'user' => 'user'
    ])->except(['show']);

    // Profile
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
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
