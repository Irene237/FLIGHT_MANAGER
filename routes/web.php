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

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFlightController;


// ======================================================
// PAGE D'ACCUEIL
// ======================================================

Route::get('/', function () {
    return view('welcome');
})->name('accueil');


// ======================================================
// AUTHENTIFICATION CLIENT
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

Route::get('/recherche-vols', [FlightSearchController::class, 'index'])
    ->name('vols.recherche');

Route::get('/resultats-recherche', [FlightSearchController::class, 'search'])
    ->name('vols.resultats');

Route::get('/vols-disponibles', [FlightSearchController::class, 'allAvailable'])
    ->name('vols.disponibles');


// ======================================================
// RÉSERVATIONS
// ======================================================

Route::get('/mes-reservations', [ReservationController::class, 'index'])
    ->middleware('auth')
    ->name('reservations.index');

Route::get('/reservation/{flight}', [ReservationController::class, 'create'])
    ->middleware('auth')
    ->name('reservations.create');

Route::post('/reservation/{flight}', [ReservationController::class, 'store'])
    ->middleware('auth')
    ->name('reservations.store');

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

Route::get('/paiement/{reservation}', [PaymentController::class, 'create'])
    ->middleware('auth')
    ->name('paiements.create');

Route::post('/paiement/{reservation}', [PaymentController::class, 'store'])
    ->middleware('auth')
    ->name('paiements.store');

Route::get('/paiement/{reservation}/billet-pdf', [PaymentController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('paiements.pdf');


// ======================================================
// BAGAGES
// ======================================================

Route::get('/mes-bagages', [BaggageController::class, 'index'])
    ->middleware('auth')
    ->name('bagages.index');

Route::post('/mes-bagages', [BaggageController::class, 'store'])
    ->middleware('auth')
    ->name('bagages.store');


// ======================================================
// ENREGISTREMENT EN LIGNE (CHECK-IN)
// ======================================================

Route::get('/enregistrement-en-ligne', [CheckInController::class, 'index'])
    ->middleware('auth')
    ->name('checkin.index');

Route::post('/enregistrement-en-ligne/{reservation}/{passenger}', [CheckInController::class, 'store'])
    ->middleware('auth')
    ->name('checkin.store');


// ======================================================
// CARTES D'EMBARQUEMENT
// ======================================================

Route::get('/carte-embarquement/{checkIn}', [CheckInController::class, 'boardingPass'])
    ->middleware('auth')
    ->name('checkin.boarding-pass');

Route::get('/carte-embarquement/{checkIn}/pdf', [CheckInController::class, 'downloadPdf'])
    ->middleware('auth')
    ->name('checkin.pdf');


// ======================================================
// HISTORIQUE DES VOYAGES
// ======================================================

Route::get('/mes-voyages', [VoyageHistoryController::class, 'index'])
    ->middleware('auth')
    ->name('voyages.index');

Route::get('/mes-voyages/{reservation}/details', [VoyageDetailsController::class, 'show'])
    ->middleware('auth')
    ->name('voyages.details');


// ======================================================
// ESPACE ADMINISTRATEUR
// ======================================================

// Connexion administrateur
Route::get('/admin/connexion', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/connexion', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');


// Routes protégées de l'administration
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Tableau de bord
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Gestion des vols : CRUD
    Route::resource('vols', AdminFlightController::class)
    ->parameters(['vols' => 'flight'])
    ->except(['show'])
    ->names('flights');

    // Déconnexion administrateur
    Route::post('/deconnexion', [AdminAuthController::class, 'logout'])
        ->name('logout');

});