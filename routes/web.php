<?php

use Illuminate\Support\Facades\Route;

// ======================================================
// CONTRÔLEURS CLIENT
// ======================================================

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
// CONTRÔLEURS ADMINISTRATEUR
// ======================================================

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminFlightController;
use App\Http\Controllers\Admin\AdminAircraftController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBaggageController;
use App\Http\Controllers\Admin\CrewMemberController;
use App\Http\Controllers\Admin\SystemSettingController;


// ======================================================
// PAGE D'ACCUEIL
// ======================================================

Route::get('/', function () {
    return view('welcome');
})->name('accueil');


// ======================================================
// AUTHENTIFICATION CLIENT
// ======================================================

Route::middleware('guest')->group(function () {

    Route::get('/connexion', [AuthController::class, 'showLogin'])
        ->name('connexion');

    Route::post('/connexion', [AuthController::class, 'login'])
        ->name('login');

    Route::get('/inscription', [AuthController::class, 'showRegister'])
        ->name('inscription');

    Route::post('/inscription', [AuthController::class, 'register'])
        ->name('inscription.store');

});

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
// RÉSERVATIONS CLIENT
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/mes-reservations', [ReservationController::class, 'index'])
        ->name('reservations.index');

    Route::get('/reservation/{flight}', [ReservationController::class, 'create'])
        ->name('reservations.create');

    Route::post('/reservation/{flight}', [ReservationController::class, 'store'])
        ->name('reservations.store');

    Route::post('/mes-reservations/{reservation}/annuler', [ReservationController::class, 'cancel'])
        ->name('reservations.cancel');

});


// ======================================================
// SUIVI DES VOLS
// ======================================================

Route::get('/suivi-vol/{reservation}', [FlightTrackingController::class, 'show'])
    ->middleware('auth')
    ->name('vols.suivi');


// ======================================================
// PAIEMENTS ET BILLETS
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/paiement/{reservation}', [PaymentController::class, 'create'])
        ->name('paiements.create');

    Route::post('/paiement/{reservation}', [PaymentController::class, 'store'])
        ->name('paiements.store');

    Route::get('/paiement/{reservation}/billet-pdf', [PaymentController::class, 'downloadPdf'])
        ->name('paiements.pdf');

});


// ======================================================
// BAGAGES CLIENT
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/mes-bagages', [BaggageController::class, 'index'])
        ->name('bagages.index');

    Route::post('/mes-bagages', [BaggageController::class, 'store'])
        ->name('bagages.store');

});


// ======================================================
// ENREGISTREMENT EN LIGNE (CHECK-IN)
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/enregistrement-en-ligne', [CheckInController::class, 'index'])
        ->name('checkin.index');

    Route::post('/enregistrement-en-ligne/{reservation}/{passenger}', [CheckInController::class, 'store'])
        ->name('checkin.store');

});


// ======================================================
// CARTES D'EMBARQUEMENT
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/carte-embarquement/{checkIn}', [CheckInController::class, 'boardingPass'])
        ->name('checkin.boarding-pass');

    Route::get('/carte-embarquement/{checkIn}/pdf', [CheckInController::class, 'downloadPdf'])
        ->name('checkin.pdf');

});


// ======================================================
// HISTORIQUE DES VOYAGES
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get('/mes-voyages', [VoyageHistoryController::class, 'index'])
        ->name('voyages.index');

    Route::get('/mes-voyages/{reservation}/details', [VoyageDetailsController::class, 'show'])
        ->name('voyages.details');

});


// ======================================================
// CONNEXION ADMINISTRATEUR
// ======================================================

Route::get('/admin/connexion', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/connexion', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');


// ======================================================
// ROUTES ADMINISTRATEUR PROTÉGÉES
// ======================================================

Route::middleware('admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // --------------------------------------------------
        // TABLEAU DE BORD
        // --------------------------------------------------

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');


        // --------------------------------------------------
        // GESTION DES VOLS
        // --------------------------------------------------

        Route::resource('vols', AdminFlightController::class)
            ->parameters(['vols' => 'flight'])
            ->except(['show'])
            ->names('flights');


        // --------------------------------------------------
        // GESTION DES AVIONS
        // --------------------------------------------------

        Route::resource('avions', AdminAircraftController::class)
            ->parameters(['avions' => 'aircraft'])
            ->names('aircraft');


        // --------------------------------------------------
        // GESTION DES RÉSERVATIONS
        // --------------------------------------------------

        Route::get('/reservations/export/pdf', [AdminReservationController::class, 'exportPdf'])
            ->name('reservations.export.pdf');

        Route::get('/reservations', [AdminReservationController::class, 'index'])
            ->name('reservations.index');


        // --------------------------------------------------
        // GESTION DES UTILISATEURS
        // --------------------------------------------------

        Route::get('/utilisateurs', [AdminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/utilisateurs/creer', [AdminUserController::class, 'create'])
            ->name('users.create');

        Route::post('/utilisateurs', [AdminUserController::class, 'store'])
            ->name('users.store');


        // --------------------------------------------------
        // GESTION DES BAGAGES
        // --------------------------------------------------

        Route::get('/bagages', [AdminBaggageController::class, 'index'])
            ->name('baggage.index');

        Route::get('/bagages/creer', [AdminBaggageController::class, 'create'])
            ->name('baggage.create');

        Route::post('/bagages', [AdminBaggageController::class, 'store'])
            ->name('baggage.store');

        Route::get('/bagages/{baggage}/modifier', [AdminBaggageController::class, 'edit'])
            ->name('baggage.edit');

        Route::put('/bagages/{baggage}', [AdminBaggageController::class, 'update'])
            ->name('baggage.update');

        Route::delete('/bagages/{baggage}', [AdminBaggageController::class, 'destroy'])
            ->name('baggage.destroy');


        // --------------------------------------------------
        // SIGNALEMENT DES INCIDENTS DE BAGAGES
        // --------------------------------------------------

        Route::post('/bagages/incidents', [AdminBaggageController::class, 'reportIncident'])
            ->name('baggage.incidents.store');


        // --------------------------------------------------
        // GESTION DES ÉQUIPAGES
        // --------------------------------------------------

        Route::get('/equipages', [CrewMemberController::class, 'index'])
            ->name('crew.index');

        Route::get('/equipages/creer', [CrewMemberController::class, 'create'])
            ->name('crew.create');

        Route::post('/equipages', [CrewMemberController::class, 'store'])
            ->name('crew.store');

        Route::get('/equipages/{crewMember}/modifier', [CrewMemberController::class, 'edit'])
            ->name('crew.edit');

        Route::put('/equipages/{crewMember}', [CrewMemberController::class, 'update'])
            ->name('crew.update');

        Route::delete('/equipages/{crewMember}', [CrewMemberController::class, 'destroy'])
            ->name('crew.destroy');


        // AFFECTATION D'UN MEMBRE À UN VOL

        Route::post('/equipages/affecter', [CrewMemberController::class, 'storeAssignment'])
            ->name('crew.assignments.store');


        // ANNULATION D'UNE AFFECTATION

        Route::post('/equipages/affectations/{assignment}/annuler', [CrewMemberController::class, 'cancelAssignment'])
            ->name('crew.assignments.cancel');


        // --------------------------------------------------
        // PARAMÈTRES SYSTÈME
        // --------------------------------------------------

        Route::get('/parametres', [SystemSettingController::class, 'index'])
            ->name('settings.index');

        Route::put('/parametres', [SystemSettingController::class, 'update'])
            ->name('settings.update');


        // --------------------------------------------------
        // DÉCONNEXION ADMINISTRATEUR
        // --------------------------------------------------

        Route::post('/deconnexion', [AdminAuthController::class, 'logout'])
            ->name('logout');

    });