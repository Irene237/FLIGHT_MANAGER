
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('accueil');

// Connexion
Route::get('/connexion', [AuthController::class, 'showLogin'])
    ->name('connexion');

Route::post('/connexion', [AuthController::class, 'login'])
    ->name('login');

// Déconnexion
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

    // Inscription
Route::get('/inscription', [AuthController::class, 'showRegister'])
    ->name('inscription');

Route::post('/inscription', [AuthController::class, 'register'])
    ->name('inscription.store');
// dashboard
    Route::get('/tableau-de-bord', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
