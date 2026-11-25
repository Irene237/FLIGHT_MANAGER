<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carte d'embarquement | FLIGHT MANAGER</title>

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
            --navy-dark: #0e243e;
            --blue: #185fa8;
            --blue-hover: #124a84;
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #102a43;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --logout-red: #dc3545;
            --badge-green-bg: #dcfce7;
            --badge-green-text: #15803d;
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

        button {
            font-family: inherit;
        }

        /* TOPBAR */
        .topbar {
            min-height: 68px;
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

        .brand-icon {
            font-size: 22px;
            line-height: 1;
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

        /* MAIN CONTAINER */
        .page-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 24px 24px 50px;
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
            margin-bottom: 24px;
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

        /* ALERT */
        .success-alert {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        /* BOARDING PASS CARD */
        .boarding-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(16, 42, 67, 0.045);
        }

        .boarding-header {
            background: var(--navy-dark);
            color: #ffffff;
            padding: 18px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .boarding-title {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .boarding-title-icon {
            font-size: 21px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 102px;
            padding: 5px 16px;
            border-radius: 999px;
            background: var(--badge-green-bg);
            color: var(--badge-green-text);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .boarding-body {
            padding: 28px 30px 30px;
        }

        .boarding-main-grid {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 32px;
            align-items: start;
        }

        .info-stack {
            display: flex;
            flex-direction: column;
            gap: 26px;
            min-width: 0;
        }

        .field-label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: var(--text-muted);
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .passenger-value {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
        }

        .route-row {
            display: grid;
            grid-template-columns: repeat(2, minmax(190px, 260px));
            gap: 28px;
        }

        .airport-name {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .airport-sub {
            font-size: 11.5px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .flight-meta-row {
            display: grid;
            grid-template-columns: repeat(4, minmax(95px, 130px));
            gap: 22px;
        }

        .meta-value {
            font-size: 14px;
            font-weight: 800;
            color: var(--text-main);
            overflow-wrap: anywhere;
        }

        /* QR CODE */
        .qr-panel {
            width: 172px;
            min-height: 172px;
            background: #f4f7fb;
            border: 1px solid #e6ecf3;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 14px;
            text-align: center;
            margin-right: 12px;
        }

        .qr-panel svg {
            width: 136px;
            height: 136px;
            display: block;
        }

        .qr-caption {
            font-size: 10px;
            font-weight: 700;
            color: var(--blue);
            margin-top: 7px;
        }

        /* ADDITIONAL INFORMATION */
        .boarding-bottom {
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px dashed #d5deea;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .gate-note {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 230px;
            height: 42px;
            padding: 0 24px;
            border-radius: 8px;
            background: var(--blue);
            color: #ffffff;
            font-size: 12.5px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-download:hover {
            background: var(--blue-hover);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
            height: 42px;
            padding: 0 20px;
            border-radius: 8px;
            background: #eef4fb;
            color: var(--blue);
            font-size: 12.5px;
            font-weight: 700;
        }

        .btn-back:hover {
            background: #dceafa;
        }

        /* FOOTER */
        .boarding-footer {
            background: #f8fafc;
            border-top: 1px solid var(--border-soft);
            padding: 15px 28px;
            text-align: center;
            color: var(--text-muted);
            font-size: 10px;
        }

        /* PRINT */
        @media print {
            body {
                background: #ffffff;
            }

            .topbar,
            .logout-bar,
            .page-heading,
            .success-alert,
            .btn-download,
            .btn-back {
                display: none !important;
            }

            .page-container {
                margin: 0 auto;
                padding: 0;
            }

            .boarding-card {
                box-shadow: none;
                border: 1px solid #cbd5e1;
            }
        }

        /* RESPONSIVE */
        @media (max-width: 860px) {
            .boarding-main-grid {
                grid-template-columns: 1fr;
            }

            .qr-panel {
                margin-right: 0;
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

            .boarding-body {
                padding: 20px;
            }

            .route-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .flight-meta-row {
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .btn-download,
            .btn-back {
                width: 100%;
            }
        }

        @media (max-width: 420px) {
            .boarding-header {
                padding: 16px;
            }

            .boarding-title {
                font-size: 12px;
            }

            .status-badge {
                min-width: auto;
                padding: 5px 9px;
            }

            .airport-name {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

@php
    $flight = $checkIn->flight;
    $departure = $flight->departureAirport;
    $arrival = $flight->arrivalAirport;
    $passenger = $checkIn->passenger;

    $depDateShort = \Carbon\Carbon::parse($flight->departure_at)
        ->locale('fr')
        ->translatedFormat('d M Y');

    $depTime = \Carbon\Carbon::parse($flight->departure_at)->format('H:i');
    $arrTime = \Carbon\Carbon::parse($flight->arrival_at)->format('H:i');
@endphp

<!-- BARRE DE NAVIGATION -->
<header class="topbar">

    <a href="{{ route('accueil') }}" class="brand">
        <span class="brand-icon">✈️</span>
        <span>FLIGHT MANAGER</span>
    </a>

    <div class="nav-right">
        <nav class="nav-links" aria-label="Navigation principale">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('vols.recherche') }}">Rechercher un vol</a>
            <a href="{{ route('reservations.index') }}" class="active">Mes réservations</a>
            <a href="{{ route('dashboard') }}#voyages">Mes voyages</a>
        </nav>

        <a href="{{ route('dashboard') }}" class="account-pill">
            Mon compte
        </a>
    </div>

</header>

<main class="page-container">

    <!-- DÉCONNEXION -->
    <div class="logout-bar">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    ↪ Déconnexion
                </button>
            </form>
        @endauth
    </div>

    <!-- TITRE -->
    <section class="page-heading">
        <h1>Carte d'embarquement</h1>
        <p>
            Votre enregistrement est terminé.
            Présentez cette carte à l'aéroport.
        </p>
    </section>

    <!-- MESSAGE DE CONFIRMATION -->
    <div class="success-alert">
        ✓ Votre enregistrement a été effectué avec succès.
    </div>

    <!-- CARTE D'EMBARQUEMENT -->
    <article class="boarding-card">

        <div class="boarding-header">

            <div class="boarding-title">
                <span class="boarding-title-icon">✈️</span>
                <span>CARTE D'EMBARQUEMENT</span>
            </div>

            <span class="status-badge">
                Enregistré
            </span>

        </div>

        <div class="boarding-body">

            <div class="boarding-main-grid">

                <!-- COLONNE GAUCHE : INFORMATIONS -->
                <div class="info-stack">

                    <!-- PASSAGER -->
                    <div>
                        <span class="field-label">PASSAGER</span>

                        <div class="passenger-value">
                            {{ $passenger->first_name }}
                            {{ $passenger->last_name }}
                        </div>
                    </div>

                    <!-- TRAJET -->
                    <div class="route-row">

                        <div>
                            <span class="field-label">DÉPART</span>

                            <div class="airport-name">
                                {{ strtoupper($departure->city) }}
                                ({{ strtoupper($departure->code) }})
                            </div>

                            <div class="airport-sub">
                                {{ strtoupper($depDateShort) }}
                                • {{ $depTime }}
                            </div>
                        </div>

                        <div>
                            <span class="field-label">ARRIVÉE</span>

                            <div class="airport-name">
                                {{ strtoupper($arrival->city) }}
                                ({{ strtoupper($arrival->code) }})
                            </div>

                            <div class="airport-sub">
                                {{ $arrTime }}
                            </div>
                        </div>

                    </div>

                    <!-- INFORMATIONS DU VOL -->
                    <div class="flight-meta-row">

                        <div>
                            <span class="field-label">VOL</span>
                            <div class="meta-value">
                                {{ $flight->flight_number }}
                            </div>
                        </div>

                        <div>
                            <span class="field-label">SIÈGE</span>
                            <div class="meta-value">
                                {{ $checkIn->seat_number }}
                            </div>
                        </div>

                        <div>
                            <span class="field-label">AVION</span>
                            <div class="meta-value">
                                {{ $flight->aircraft?->model ?? 'Non renseigné' }}
                            </div>
                        </div>

                        <div>
                            <span class="field-label">RÉSERVATION</span>
                            <div class="meta-value">
                                {{ $checkIn->reservation->reference }}
                            </div>
                        </div>

                    </div>

                    <!-- RÉFÉRENCE CHECK-IN -->
                    <div>
                        <span class="field-label">
                            RÉFÉRENCE D'ENREGISTREMENT
                        </span>

                        <div class="meta-value">
                            {{ $checkIn->checkin_reference }}
                        </div>
                    </div>

                    <!-- DATE D'ENREGISTREMENT -->
                    <div>
                        <span class="field-label">
                            ENREGISTRÉ LE
                        </span>

                        <div class="meta-value">
                            {{ $checkIn->checked_in_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>

                </div>

                <!-- COLONNE DROITE : QR CODE -->
                <div
                    class="qr-panel"
                    title="Référence : {{ $checkIn->checkin_reference }}"
                >

                    @if(!empty($qrCode))
                        {!! $qrCode !!}
                    @else
                        <span style="font-size: 30px; font-weight: 800; color: #185fa8;">
                            QR
                        </span>

                        <span class="qr-caption">
                            CODE INDISPONIBLE
                        </span>
                    @endif

                    <span class="qr-caption">
                        CODE DE VÉRIFICATION
                    </span>

                </div>

            </div>

            <!-- PIED DE CARTE -->
            <div class="boarding-bottom">

                <span class="gate-note">
                    Conservez cette carte et présentez votre QR code
                    lors des contrôles d'embarquement.
                    <br>
                    La porte d'embarquement sera communiquée ultérieurement.
                </span>

                <a
                    href="{{ route('checkin.pdf', $checkIn) }}"
                    class="btn-download"
                >
                    Télécharger la carte
                </a>

            </div>

        </div>

        <div class="boarding-footer">
            FLIGHT MANAGER — Merci de voyager avec nous.
            Présentez votre carte d'embarquement à l'aéroport.
        </div>

    </article>

    <!-- ACTIONS -->
    <div class="boarding-bottom">

        <a href="{{ route('checkin.index') }}" class="btn-back">
            ← Retour au check-in
        </a>

        <button
            type="button"
            onclick="window.print()"
            class="btn-download"
        >
            Imprimer la carte
        </button>

    </div>

</main>

</body>
</html>