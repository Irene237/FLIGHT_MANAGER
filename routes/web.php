<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BaggageController;
use App\Http\Controllers\FlightSearchController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\FlightTrackingController;
use App\Http\Controllers\VoyageHistoryController;
use App\Http\Controllers\VoyageDetailsController;

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

    // Mes réservations
Route::get('/mes-reservations', [ReservationController::class, 'index'])
    ->middleware('auth')
    ->name('reservations.index');

    // Suivi du vol
Route::get('/suivi-vol/{reservation}', [FlightTrackingController::class, 'show'])
    ->middleware('auth')
    ->name('vols.suivi');

// Gestion des bagages
Route::get('/mes-bagages', [BaggageController::class, 'index'])
    ->middleware('auth')
    ->name('bagages.index');

Route::post('/mes-reservations/{reservation}/annuler', [ReservationController::class, 'cancel'])
    ->middleware('auth')
    ->name('reservations.cancel');

Route::post('/mes-bagages', [BaggageController::class, 'store'])
    ->middleware('auth')
    ->name('bagages.store');

// Recherche de vols
Route::get('/recherche-vols', [FlightSearchController::class, 'index'])
    ->name('vols.recherche');

// Résultats de recherche
Route::get('/resultats-recherche', [FlightSearchController::class, 'search'])
    ->name('vols.resultats');

// Réservation d'un vol
Route::get('/reservation/{flight}', [ReservationController::class, 'create'])
    ->middleware('auth')
    ->name('reservations.create');

Route::post('/reservation/{flight}', [ReservationController::class, 'store'])
    ->middleware('auth')
    ->name('reservations.store');

    // Paiement
Route::get('/paiement/{reservation}', [PaymentController::class, 'create'])
    ->middleware('auth')
    ->name('paiements.create');

Route::post('/paiement/{reservation}', [PaymentController::class, 'store'])
    ->middleware('auth')
    ->name('paiements.store');

Route::get('/paiement/{reservation}/billet-pdf', [PaymentController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('paiements.pdf');

    // Enregistrement en ligne
Route::get('/enregistrement-en-ligne', [CheckInController::class, 'index'])
    ->middleware('auth')
    ->name('checkin.index');

Route::post('/enregistrement-en-ligne/{reservation}/{passenger}', [CheckInController::class, 'store'])
    ->middleware('auth')
    ->name('checkin.store');

// Carte d'embarquement
Route::get('/carte-embarquement/{checkIn}', [CheckInController::class, 'boardingPass'])
    ->middleware('auth')
    ->name('checkin.boarding-pass');

Route::get('/carte-embarquement/{checkIn}/pdf', [CheckInController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('checkin.pdf');

Route::get('/mes-voyages', [VoyageHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('voyages.index');

Route::get('/mes-voyages/{reservation}/details', [VoyageDetailsController::class, 'show'])
    ->middleware('auth')
    ->name('voyages.details');