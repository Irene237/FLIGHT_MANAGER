<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BaggageController;
use App\Http\Controllers\FlightSearchController;

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

// Tableau de bord
Route::get('/tableau-de-bord', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Gestion des bagages
Route::get('/mes-bagages', [BaggageController::class, 'index'])
    ->middleware('auth')
    ->name('bagages.index');

Route::post('/mes-bagages', [BaggageController::class, 'store'])
    ->middleware('auth')
    ->name('bagages.store');

// Recherche de vols
Route::get('/recherche-vols', [FlightSearchController::class, 'index'])
    ->name('vols.recherche');

// Résultats de recherche
Route::get('/resultats-recherche', [FlightSearchController::class, 'search'])
    ->name('vols.resultats');