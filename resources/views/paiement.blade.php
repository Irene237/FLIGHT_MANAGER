<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Paiement et billet électronique | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --navy: #0f294a;
            --blue: #185fa8;
            --blue-hover: #124a84;
            --blue-bright: #0284c7;
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #102a43;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --input-border: #dce4ee;
            --logout-red: #dc3545;
            --green-bg: #dcfce7;
            --green-border: #86efac;
            --green-text: #15803d;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input {
            font-family: inherit;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            height: 68px;
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.3px;
            color: var(--navy);
            white-space: nowrap;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 500;
            color: #52647a;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--blue);
            font-weight: 700;
        }

        .account-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: #eef4fb;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ===== MAIN CONTAINER ===== */
        .page-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 22px 24px 42px;
        }

        .logout-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 4px;
            min-height: 24px;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            border: none;
            color: var(--logout-red);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background: #fff1f2;
        }

        .page-heading {
            margin-bottom: 18px;
        }

        .page-heading h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* ===== STEPPER ===== */
        .progress {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            margin: 18px 0 30px;
            flex-wrap: wrap;
        }

        .step {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            position: relative;
        }

        .step-circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }

        .step.done .step-circle,
        .step.active .step-circle {
            background: var(--blue);
            color: #ffffff;
        }

        .step.active {
            color: var(--blue);
            font-weight: 700;
        }

        .step-sub-num {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: var(--text-muted);
            text-align: center;
            margin-top: 2px;
        }

        .progress-line {
            width: 72px;
            height: 1.5px;
            background: #cbd5e1;
        }

        .progress-line.filled {
            background: var(--blue);
        }

        /* ===== ALERTS ===== */
        .error-box {
            background: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* ===== MAIN TWO-COLUMN GRID ===== */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: stretch;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 24px 26px;
            box-shadow: 0 2px 12px rgba(16, 42, 67, 0.035);
        }

        .card h2 {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .card-description {
            color: var(--text-muted);
            font-size: 12.5px;
            margin-bottom: 18px;
        }

        /* ===== LEFT CARD: PAYMENT METHODS ===== */
        .payment-methods {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 58px;
            padding: 10px 12px;
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            cursor: pointer;
            background: #ffffff;
            transition: border-color 0.2s, background 0.2s;
        }

        .payment-option.selected {
            background: #f4f9ff;
            border: 1.5px solid var(--blue);
        }

        .payment-option input[type="radio"] {
            width: 15px;
            height: 15px;
            accent-color: var(--blue);
            flex-shrink: 0;
        }

        .payment-icon {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .mtn {
            background: #ffcc00;
            color: #102a43;
        }

        .orange {
            background: #f97316;
            color: #ffffff;
        }

        .bank {
            background: #e8f1fa;
            color: var(--blue);
            font-size: 14px;
        }

        .payment-option strong {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: var(--text-main);
        }

        .payment-option small {
            display: block;
            color: var(--text-muted);
            font-size: 10.5px;
            margin-top: 2px;
        }

        .field {
            margin-top: 18px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 7px;
            color: var(--text-main);
        }

        .field input {
            width: 100%;
            height: 44px;
            border: 1px solid var(--input-border);
            border-radius: 9px;
            padding: 0 14px;
            font-size: 13px;
            color: var(--text-main);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .field input::placeholder {
            color: #9aa8b8;
        }

        .field input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24, 95, 168, 0.1);
        }

        .info {
            margin-top: 12px;
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .paid-status-panel {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 16px;
            color: #166534;
            font-size: 13px;
            line-height: 1.6;
        }

        /* ===== RIGHT CARD: SUMMARY ===== */
        .flight-summary {
            background: #f3f6fa;
            padding: 14px 16px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 14px 0 20px;
        }

        .plane-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e2eef8;
            color: var(--blue);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .flight-summary strong {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
        }

        .flight-summary small {
            display: block;
            color: var(--text-muted);
            margin-top: 3px;
            font-size: 11.5px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin: 13px 0;
            font-size: 12.5px;
        }

        .summary-row span {
            color: var(--text-muted);
        }

        .summary-row strong {
            color: var(--text-main);
            font-weight: 700;
            text-align: right;
        }

        .separator {
            border: none;
            border-top: 1px solid #e6ecf3;
            margin: 16px 0 14px;
        }

        .total {
            font-size: 15px;
            font-weight: 800;
            margin-bottom: 0;
        }

        .total span {
            color: var(--text-main);
        }

        .total strong {
            color: var(--blue);
            font-size: 20px;
            font-weight: 800;
        }

        /* ===== ACTION & CONFIRMATION ROW ===== */
        .action-status-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-top: 20px;
            align-items: stretch;
        }

        .pay-button {
            width: 100%;
            min-height: 56px;
            border: none;
            border-radius: 12px;
            background: var(--blue);
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .pay-button:hover {
            background: var(--blue-hover);
        }

        .pay-button:disabled {
            background: #94a3b8;
            cursor: default;
        }

        .confirmation-banner {
            background: #e7f6ec;
            border: 1px solid #b7e4c7;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .check-badge {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #16a34a;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .confirmation-banner strong {
            display: block;
            font-size: 13px;
            color: #14532d;
            margin-bottom: 2px;
        }

        .confirmation-banner span {
            display: block;
            font-size: 11.5px;
            color: #166534;
        }

        /* ===== E-TICKET CARD ===== */
        .ticket {
            margin-top: 22px;
            padding: 20px 26px;
            border-radius: 16px;
            background: linear-gradient(135deg, #f8fbff 0%, #eef6fc 100%);
            border: 2px solid #0284c7;
            display: grid;
            grid-template-columns: 1.1fr 1.15fr auto;
            align-items: center;
            gap: 24px;
        }

        .ticket-label {
            color: var(--blue);
            font-size: 10.5px;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .ticket h2 {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .ticket p {
            color: #52647a;
            font-size: 11.5px;
            line-height: 1.55;
        }

        .ticket-reference {
            border-left: 1.5px dashed #b8cad9;
            padding-left: 26px;
        }

        .ticket-ref-eyebrow {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .ticket-reference strong {
            display: block;
            font-size: 21px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .qr-box {
            text-align: center;
        }

        .qr-frame {
            width: 82px;
            height: 82px;
            background: #ffffff;
            border: 1px solid #dbe4ee;
            border-radius: 8px;
            padding: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .qr-caption {
            display: block;
            margin-top: 4px;
            font-size: 9px;
            font-weight: 600;
            color: var(--text-muted);
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 11px;
            margin-top: 26px;
        }

        /* ===== AJUSTEMENTS POUR MATCHER LA MAQUETTE ===== */
        :root { --bg-page: #f0f4f9; }

        /* Topbar */
        .topbar { height: 60px; padding: 0 40px; }
        .brand { font-size: 20px; gap: 8px; }
        .brand span:first-child { font-size: 20px !important; }
        .nav-right { gap: 30px; }
        .nav-links { gap: 38px; }
        .nav-links a { font-size: 11px; color: #718296; }
        .nav-links a:hover,
        .nav-links a.active { color: var(--blue); font-weight: 700; }
        .account-pill { padding: 6px 12px; font-size: 10px; }

        /* Conteneur et titre */
        .page-container { max-width: 996px; padding: 14px 48px 24px; }
        .logout-bar { margin-bottom: 0; min-height: 20px; }
        .logout-btn { font-size: 9.5px; padding: 2px 4px; }
        .page-heading { margin-bottom: 8px; }
        .page-heading h1 { font-size: 22px; letter-spacing: -0.4px; margin-bottom: 6px; }
        .page-heading p { font-size: 11px; }

        /* Stepper */
        .progress { gap: 0; margin: 16px 0 28px; flex-wrap: nowrap; }
        .step { gap: 7px; font-size: 10.5px; }
        .step > div { position: relative; display: flex; }
        .step-circle { width: 22px; height: 22px; font-size: 10px; }
        .step-sub-num {
            position: absolute; top: 100%; left: 50%;
            transform: translateX(-50%);
            margin-top: 8px; font-size: 9px;
        }
        .progress-line { width: 58px; margin-left: 20px; margin-right: 8px; }

        /* Cartes */
        .content-grid { gap: 22px; }
        .card { padding: 22px; border-radius: 12px; }
        .card h2 { font-size: 16px; margin-bottom: 4px; }
        .card-description { font-size: 11px; margin-bottom: 14px; }

        /* Moyens de paiement */
        .payment-methods { gap: 12px; }
        .payment-option { min-height: 47px; padding: 8px 12px; border-radius: 8px; gap: 10px; }
        .payment-option input[type="radio"] { width: 14px; height: 14px; }
        .payment-icon { width: 24px; height: 24px; border-radius: 5px; font-size: 8px; }
        .bank { font-size: 14px; line-height: 1; }
        .payment-option strong { font-size: 11px; }
        .payment-option small { font-size: 9px; margin-top: 2px; }

        .field { margin-top: 22px; }
        .field label { font-size: 11px; margin-bottom: 6px; }
        .field input { height: 34px; border-radius: 8px; padding: 0 12px; font-size: 12px; }
        .info { font-size: 9.5px; margin-top: 8px; }

        /* Récapitulatif */
        .flight-summary { padding: 12px 14px; border-radius: 10px; margin: 12px 0 14px; gap: 12px; }
        .plane-icon { width: 28px; height: 28px; font-size: 13px; }
        .flight-summary strong { font-size: 12px; }
        .flight-summary small { font-size: 10px; margin-top: 2px; }
        .summary-row { font-size: 11px; margin: 14px 0; }
        .separator { margin: 12px 0 10px; }
        .summary-row.total {
            font-size: 13px;
            padding-bottom: 8px;
            margin-bottom: 0;
            border-bottom: 1px solid var(--border-soft);
        }
        .total strong { font-size: 20px; }

        /* Bouton + bannière */
        .action-status-grid { gap: 22px; margin-top: 20px; }
        .pay-button { min-height: 54px; border-radius: 10px; font-size: 13px; }
        .confirmation-banner { min-height: 54px; padding: 0 16px; border-radius: 10px; gap: 12px; }
        .confirmation-banner strong { font-size: 12px; margin-bottom: 1px; }
        .confirmation-banner div span { font-size: 10.5px; }
        /* Correctif : la règle ".confirmation-banner span" écrasait le badge ✓ */
        .confirmation-banner .check-badge {
            display: inline-flex; width: 26px; height: 26px;
            color: #ffffff; font-size: 13px; font-weight: 800;
        }

        /* Billet électronique */
        .ticket {
            margin-top: 20px; padding: 18px 22px; border-radius: 12px;
            border: 1px solid #d3e2f0;
            grid-template-columns: 1fr 1fr auto; gap: 24px;
        }
        .ticket-label { font-size: 9.5px; margin-bottom: 6px; }
        .ticket h2 { font-size: 17px; margin-bottom: 6px; }
        .ticket p { font-size: 10px; line-height: 1.7; }
        .ticket-reference { padding-left: 28px; }
        .ticket-ref-eyebrow { font-size: 9px; }
        .ticket-reference strong { font-size: 20px; margin-bottom: 6px; }
        .qr-frame { width: 92px; height: 92px; padding: 8px; }
        .qr-frame svg { width: 100%; height: 100%; }
        .qr-caption { font-size: 8px; }

        .footer { font-size: 9.5px; margin-top: 14px; }

.download-ticket {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 16px;
    padding: 12px 22px;
    background: var(--blue);
    color: white;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    transition: background 0.2s;
}

.download-ticket:hover {
    background: var(--blue-hover);
}

        /* ===== RESPONSIVE ===== */
        @media (max-width: 920px) {
            .content-grid,
            .action-status-grid {
                grid-template-columns: 1fr;
            }

            .ticket {
                grid-template-columns: 1fr;
            }

            .ticket-reference {
                border-left: none;
                border-top: 1.5px dashed #b8cad9;
                padding-left: 0;
                padding-top: 16px;
            }

            .qr-box {
                text-align: left;
            }
        }

        @media (max-width: 720px) {
            .topbar {
                height: auto;
                padding: 12px 16px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
                gap: 12px;
            }

            .nav-links {
                gap: 14px;
                overflow-x: auto;
            }

            .page-container {
                padding: 18px 14px 36px;
            }

            .payment-methods {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $flight = $reservation->flight;
    $passengers = $reservation->passengers;
    $firstPassenger = $passengers->first();

    $departure = $flight->departureAirport;
    $arrival = $flight->arrivalAirport;

    $departureDate = \Carbon\Carbon::parse($flight->departure_at)
        ->locale('fr')
        ->translatedFormat('d F Y');

    $departureTime = \Carbon\Carbon::parse($flight->departure_at)->format('H:i');
    $arrivalTime = \Carbon\Carbon::parse($flight->arrival_at)->format('H:i');

    $isPaid = $reservation->status === 'confirmed';

    $payment = $reservation->payments
        ->where('status', 'successful')
        ->first();

    $paymentMethodLabels = [
        'mtn_mobile_money' => 'MTN Mobile Money',
        'orange_money' => 'Orange Money',
        'bank_card' => 'Carte bancaire',
    ];
@endphp

<!-- BARRE DE NAVIGATION -->
<header class="topbar">
    <a href="{{ route('accueil') }}" class="brand">
    <span style="font-size: 23px;">✈️</span>
    <span>FLIGHT MANAGER</span>
</a>

    <div class="nav-right">
        <nav class="nav-links" aria-label="Navigation principale">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('vols.recherche') }}">Rechercher un vol</a>
            <a href="{{ route('dashboard') }}#reservations" class="active">Mes réservations</a>
            <a href="{{ route('dashboard') }}#voyages">Mes voyages</a>
        </nav>

        <a href="{{ route('dashboard') }}" class="account-pill">Mon compte</a>
    </div>
</header>

<main class="page-container">

    <!-- DECONNEXION -->
    <div class="logout-bar">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>
        @endauth
    </div>

    <!-- TITRE -->
    <div class="page-heading">
        <h1>Paiement et billet électronique</h1>
        <p>Finalisez votre réservation et consultez votre billet électronique.</p>
    </div>

    <!-- ETAPES -->
    <div class="progress">
        <div class="step done">
            <span class="step-circle">✓</span>
            <span>Réservation</span>
        </div>

        <div class="progress-line filled"></div>

        <div class="step active">
            <span class="step-circle">✓</span>
            <span>Paiement</span>
        </div>

        <div class="progress-line {{ $isPaid ? 'filled' : '' }}"></div>

        <div class="step {{ $isPaid ? 'active' : '' }}">
            <div>
                <span class="step-circle">{{ $isPaid ? '✓' : '' }}</span>
                @if(!$isPaid)
                    <span class="step-sub-num">3</span>
                @endif
            </div>
            <span>Billet</span>
        </div>
    </div>

    @if(session('error'))
        <div class="error-box">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="error-box">
            <strong>Veuillez corriger les erreurs suivantes :</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- GRILLE PRINCIPALE -->
    <div class="content-grid">

        <!-- MODE DE PAIEMENT -->
        <section class="card">
            <h2>Mode de paiement</h2>
            <p class="card-description">Choisissez un moyen de paiement pour la simulation.</p>

            @if(!$isPaid)
                <form action="{{ route('paiements.store', $reservation) }}" method="POST" id="paymentForm">
                    @csrf
                    <input type="hidden" name="simulation_result" value="successful">

                    <div class="payment-methods">
                        <label class="payment-option selected">
                            <input type="radio" name="payment_method" value="mtn_mobile_money" checked>
                            <span class="payment-icon mtn">MTN</span>
                            <span>
                                <strong>MTN Mobile Money</strong>
                                <small>Paiement simulé</small>
                            </span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="orange_money">
                            <span class="payment-icon orange">OM</span>
                            <span>
                                <strong>Orange Money</strong>
                                <small>Paiement simulé</small>
                            </span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="bank_card">
                            <span class="payment-icon bank">▬</span>
                            <span>
                                <strong>Carte bancaire</strong>
                                <small>Mode de démonstration</small>
                            </span>
                        </label>
                    </div>

                    <div class="field" id="phoneField">
                        <label for="phone_number">Numéro de téléphone (simulation)</label>
                        <input
                            type="tel"
                            id="phone_number"
                            name="phone_number"
                            value="{{ old('phone_number') }}"
                            placeholder="+237 6XX XXX XXX"
                        >
                    </div>

                    <p class="info">
                        ⓘ Aucun paiement réel ne sera effectué dans cette démonstration.
                    </p>
                </form>
            @else
                <div class="paid-status-panel">
                    <strong>✓ Paiement validé</strong><br>
                    Moyen : {{ $paymentMethodLabels[$payment->payment_method ?? ''] ?? 'Simulation' }}<br>
                    Référence transaction : <strong>{{ $payment->transaction_reference ?? 'SIM-' . $reservation->reference }}</strong>
                </div>
            @endif
        </section>

        <!-- RECAPITULATIF DE RESERVATION -->
        <section class="card">
            <h2>Récapitulatif de réservation</h2>

            <div class="flight-summary">
                <div class="plane-icon">✈</div>
                <div>
                    <strong>
                        {{ $departure->city }} ({{ $departure->code }}) → {{ $arrival->city }} ({{ $arrival->code }})
                    </strong>
                    <small>
                        {{ $flight->flight_number }} · {{ $departureDate }}
                    </small>
                </div>
            </div>

            <div class="summary-row">
                <span>Passager</span>
                <strong>
                    @if($firstPassenger)
                        {{ $firstPassenger->first_name }} {{ $firstPassenger->last_name }}
                    @endif
                    @if($passengers->count() > 1)
                        (+{{ $passengers->count() - 1 }})
                    @endif
                </strong>
            </div>

            <div class="summary-row">
                <span>Nombre de places</span>
                <strong>
                    {{ $reservation->number_of_seats }} {{ $reservation->number_of_seats > 1 ? 'adultes' : 'adulte' }}
                </strong>
            </div>

            <div class="summary-row">
                <span>Prix du billet</span>
                <strong>{{ number_format($flight->price, 0, ',', ' ') }} FCFA</strong>
            </div>

            <hr class="separator">

            <div class="summary-row total">
                <span>Montant à payer</span>
                <strong>{{ number_format($reservation->total_amount, 0, ',', ' ') }} FCFA</strong>
            </div>
        </section>

    </div>

    <!-- BOUTON CONFIRMER + BANNIERE CONFIRMATION -->
    <div class="action-status-grid">
        @if(!$isPaid)
            <button type="submit" form="paymentForm" class="pay-button">
                Confirmer le paiement (simulation)
            </button>
        @else
            <button type="button" class="pay-button" disabled>
                Paiement confirmé
            </button>
        @endif

        @if($isPaid)
    <div class="confirmation-banner">
        <span class="check-badge">✓</span>
        <div>
            <strong>Paiement simulé confirmé</strong>
            <span>Votre réservation est confirmée.</span>
        </div>
    </div>
@endif
    </div>

    <!-- APERCU DU BILLET ELECTRONIQUE -->
     @if($isPaid)
    <section class="ticket">
            <div>
                <div class="ticket-label">FLIGHT MANAGER · BILLET ÉLECTRONIQUE</div>
                <h2>{{ $departure->city }} <span style="color: var(--blue-bright);">→</span> {{ $arrival->city }}</h2>
                <p>Passager : {{ $firstPassenger->first_name ?? '' }} {{ $firstPassenger->last_name ?? '' }}</p>
              <p>Vol {{ $flight->flight_number }} · {{ $departureDate }}</p>
            </div>

            <div class="ticket-reference">
                <div class="ticket-ref-eyebrow">RÉFÉRENCE DE RÉSERVATION</div>
                <strong>{{ $reservation->reference }}</strong>
                <p>Départ : {{ $departureTime }} · Arrivée : {{ $arrivalTime }}</p>
                <p>Montant réglé : {{ number_format($reservation->total_amount, 0, ',', ' ') }} FCFA · Statut : Payé (simulation)</p>
            </div>

            <div class="qr-box">
    <div class="qr-frame">
        @if($qrCode)
            {!! $qrCode !!}
        @else
            <span style="font-size: 10px; color: #718296;">
                QR indisponible
            </span>
        @endif
    </div>

    <span class="qr-caption">BILLET ÉLECTRONIQUE</span>
</div>
    </section>
    <div style="text-align: center;">
    <a href="{{ route('paiements.pdf', $reservation) }}"
       class="download-ticket">
        ↓ Télécharger mon billet PDF
    </a>
</div>
@endif
    <footer class="footer">
        Maquette de démonstration · Paiement fictif, aucun débit réel · © {{ date('Y') }} FLIGHT MANAGER
    </footer>

</main>

<script>
    const options = document.querySelectorAll('.payment-option');
    const phoneField = document.getElementById('phoneField');

    function updatePaymentSelection() {
        options.forEach(option => {
            const radio = option.querySelector('input[type="radio"]');
            option.classList.toggle('selected', radio.checked);
        });

        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (phoneField) {
            phoneField.style.display = (selected && selected.value === 'bank_card') ? 'none' : 'block';
        }
    }

    options.forEach(option => {
        option.addEventListener('click', updatePaymentSelection);
    });

    updatePaymentSelection();
</script>

</body>
</html>