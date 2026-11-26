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


// ======================================================
// PAGE D'ACCUEIL
// ======================================================

Route::get('/', function () {
    return view('welcome');
})->name('accueil');


// ======================================================
// AUTHENTIFICATION
// ======================================================

// Connexion
Route::get('/connexion', [AuthController::class, 'showLogin'])
    ->name('connexion');

Route::post('/connexion', [AuthController::class, 'login'])
    ->name('login');

// Inscription
Route::get('/inscription', [AuthController::class, 'showRegister'])
    ->name('inscription');

Route::post('/inscription', [AuthController::class, 'register'])
    ->name('inscription.store');

// Déconnexion
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


// ======================================================
// TABLEAU DE BORD CLIENT
// ======================================================

Route::get('/tableau-de-bord', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


// ======================================================
// RECHERCHE DE VOLS
// ======================================================

// Afficher le formulaire de recherche
Route::get('/recherche-vols', [FlightSearchController::class, 'index'])
    ->name('vols.recherche');

// Afficher les résultats de recherche
Route::get('/resultats-recherche', [FlightSearchController::class, 'search'])
    ->name('vols.resultats');

// Afficher tous les vols disponibles
Route::get('/vols-disponibles', [FlightSearchController::class, 'allAvailable'])
    ->name('vols.disponibles');


// ======================================================
// RÉSERVATIONS
// ======================================================

// Mes réservations
Route::get('/mes-reservations', [ReservationController::class, 'index'])
    ->middleware('auth')
    ->name('reservations.index');

// Réserver un vol
Route::get('/reservation/{flight}', [ReservationController::class, 'create'])
    ->middleware('auth')
    ->name('reservations.create');

Route::post('/reservation/{flight}', [ReservationController::class, 'store'])
    ->middleware('auth')
    ->name('reservations.store');

// Annuler une réservation
Route::post('/mes-reservations/{reservation}/annuler', [ReservationController::class, 'cancel'])
    ->middleware('auth')
    ->name('reservations.cancel');


// ======================================================
// SUIVI DES VOLS
// ======================================================

Route::get('/suivi-vol/{reservation}', [FlightTrackingController::class, 'show'])
    ->middleware('auth')
    ->name('vols.suivi');


// ======================================================
// PAIEMENTS ET BILLETS
// ======================================================

// Afficher la page de paiement
Route::get('/paiement/{reservation}', [PaymentController::class, 'create'])
    ->middleware('auth')
    ->name('paiements.create');

// Effectuer le paiement
Route::post('/paiement/{reservation}', [PaymentController::class, 'store'])
    ->middleware('auth')
    ->name('paiements.store');

// Télécharger le billet PDF
Route::get('/paiement/{reservation}/billet-pdf', [PaymentController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('paiements.pdf');


// ======================================================
// BAGAGES
// ======================================================

// Afficher mes bagages
Route::get('/mes-bagages', [BaggageController::class, 'index'])
    ->middleware('auth')
    ->name('bagages.index');

// Enregistrer un bagage
Route::post('/mes-bagages', [BaggageController::class, 'store'])
    ->middleware('auth')
    ->name('bagages.store');


// ======================================================
// ENREGISTREMENT EN LIGNE (CHECK-IN)
// ======================================================

// Afficher les réservations éligibles
Route::get('/enregistrement-en-ligne', [CheckInController::class, 'index'])
    ->middleware('auth')
    ->name('checkin.index');

// Effectuer l'enregistrement d'un passager
Route::post('/enregistrement-en-ligne/{reservation}/{passenger}', [CheckInController::class, 'store'])
    ->middleware('auth')
    ->name('checkin.store');


// ======================================================
// CARTES D'EMBARQUEMENT
// ======================================================

// Afficher la carte d'embarquement
Route::get('/carte-embarquement/{checkIn}', [CheckInController::class, 'boardingPass'])
    ->middleware('auth')
    ->name('checkin.boarding-pass');

// Télécharger la carte d'embarquement en PDF
Route::get('/carte-embarquement/{checkIn}/pdf', [CheckInController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('checkin.pdf');


// ======================================================
// HISTORIQUE DES VOYAGES
// ======================================================

Route::get('/mes-voyages', [VoyageHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('voyages.index');

// Détails d'un voyage
Route::get('/mes-voyages/{reservation}/details', [VoyageDetailsController::class, 'show'])
    ->middleware('auth')
    ->name('voyages.details');