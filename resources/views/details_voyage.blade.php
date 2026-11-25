<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du voyage | FLIGHT MANAGER</title>

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
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #102a43;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --logout-red: #dc3545;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --blue-bg: #e6f0fa;
            --blue-text: #185fa8;
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
            padding: 24px 24px 56px;
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

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 26px 30px;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        /* ===== TOP TRIP SUMMARY CARD ===== */
        .trip-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
        }

        .trip-header h2 {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-main);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 108px;
            padding: 5px 16px;
            border-radius: 999px;
            background: var(--green-bg);
            color: var(--green-text);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pill.upcoming {
            background: var(--blue-bg);
            color: var(--blue-text);
        }

        .trip-reference {
            font-size: 12.5px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .trip-times {
            display: flex;
            align-items: center;
            gap: 110px;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--text-main);
        }

        /* ===== TWO COLUMNS GRID ===== */
        .information-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .information-grid .card {
            margin-bottom: 0;
            min-height: 256px;
            padding: 28px 30px;
        }

        .card h3 {
            font-size: 15.5px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 24px;
        }

        .info-block {
            margin-bottom: 24px;
        }

        .info-block:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .info-value {
            font-size: 13.5px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.5;
        }

        .info-description {
            font-size: 12px;
            line-height: 1.75;
            color: #486581;
            max-width: 340px;
        }

        /* ===== SUMMARY ROWS ===== */
        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #eef2f7;
        }

        .summary-row:first-of-type {
            padding-top: 2px;
        }

        .summary-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .summary-row span:first-child {
            font-size: 12px;
            color: var(--text-muted);
        }

        .summary-row strong {
            font-size: 12.5px;
            font-weight: 800;
            color: var(--text-main);
            text-align: right;
        }

        .summary-row strong.completed {
            color: var(--green-text);
        }

        .summary-row strong.upcoming-text {
            color: var(--blue-text);
        }

        /* ===== FOOTNOTE ===== */
        .notice {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 34px;
            padding-left: 30px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 820px) {
            .information-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .information-grid .card {
                min-height: auto;
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
                padding: 18px 14px 40px;
            }

            .card {
                padding: 22px 20px;
            }

            .trip-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .trip-times {
                gap: 24px;
                flex-wrap: wrap;
            }

            .notice {
                padding-left: 4px;
                margin-top: 24px;
            }
        }
    </style>
</head>

<body>

@php
    $isUpcoming = ($statusLabel ?? '') === 'Voyage à venir';
    $topBadgeLabel = $isUpcoming ? 'Voyage à venir' : 'Voyage terminé';
    $bottomStatusLabel = $isUpcoming ? 'Voyage à venir' : 'Voyage effectué';
    $formattedDate = \Carbon\Carbon::parse($trip->flight->departure_at)
        ->locale('fr')
        ->translatedFormat('d F Y');
    $weightFormatted = rtrim(rtrim(number_format((float) $totalBaggageWeight, 2, ',', ' '), '0'), ',');
@endphp

<!-- BARRE DE NAVIGATION -->
<header class="topbar">
    <a href="{{ route('accueil') }}" class="brand">
    <span>✈️</span>
    <span>FLIGHT MANAGER</span>
</a>

    <div class="nav-right">
        <nav class="nav-links" aria-label="Navigation principale">
            <a href="{{ route('accueil') }}">Accueil</a>
            <a href="{{ route('vols.recherche') }}">Rechercher un vol</a>
            <a href="{{ route('reservations.index') }}">Mes réservations</a>
            <a href="{{ route('voyages.index') }}" class="active">Mes voyages</a>
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
    <section class="page-heading">
        <h1>Détails du voyage et informations d'arrivée</h1>
        <p>Toutes les informations utiles pour votre trajet et votre arrivée à destination.</p>
    </section>

    <!-- RESUME DU VOYAGE -->
    <section class="card">
        <div class="trip-header">
            <h2>
                Votre voyage :
                {{ $trip->flight->departureAirport->city }}
                →
                {{ $trip->flight->arrivalAirport->city }}
            </h2>

            <span class="status-pill {{ $isUpcoming ? 'upcoming' : '' }}">
                {{ $topBadgeLabel }}
            </span>
        </div>

        <p class="trip-reference">
            Vol {{ $trip->flight->flight_number }}
            •
            {{ $formattedDate }}
            •
            Référence {{ $trip->reference }}
        </p>

        <div class="trip-times">
            <span>
                Départ : {{ \Carbon\Carbon::parse($trip->flight->departure_at)->format('H:i') }}
            </span>

            <span>
                Arrivée prévue : {{ \Carbon\Carbon::parse($trip->flight->arrival_at)->format('H:i') }}
            </span>
        </div>
    </section>

    <!-- INFORMATIONS & RECAPITULATIF -->
    <div class="information-grid">

        <!-- INFORMATIONS A L'ARRIVEE -->
        <section class="card">
            <h3>Informations à l'arrivée</h3>

            <div class="info-block">
                <p class="info-label">Aéroport d'arrivée</p>
                <p class="info-value">
                    {{ $trip->flight->arrivalAirport->name }} ({{ $trip->flight->arrivalAirport->code }})
                </p>
            </div>

            <div class="info-block">
                <p class="info-label">Récupération des bagages</p>
                <p class="info-description">
                    Consultez les écrans de l'aéroport pour connaître
                    le tapis de livraison de vos bagages.
                </p>
            </div>
        </section>

        <!-- RECAPITULATIF DU VOYAGE -->
        <section class="card">
            <h3>Récapitulatif du voyage</h3>

            <div class="summary-row">
                <span>Passager</span>
                <strong>
                    @if($trip->passengers->isNotEmpty())
                        {{ ucfirst($trip->passengers->first()->first_name) }}
                        {{ $trip->passengers->first()->last_name }}
                    @else
                        Non renseigné
                    @endif
                </strong>
            </div>

            <div class="summary-row">
                <span>Billet</span>
                <strong>{{ $trip->flight->flight_number }}</strong>
            </div>

            <div class="summary-row">
                <span>Bagage en soute</span>
                <strong>
    {{ $baggageCount }} bagage(s)
    •
    {{ number_format((float) $totalBaggageWeight, 2, ',', ' ') }} kg au total
</strong>
            </div>

            <div class="summary-row">
                <span>Statut</span>
                <strong class="{{ $isUpcoming ? 'upcoming-text' : 'completed' }}">
                    {{ $bottomStatusLabel }}
                </strong>
            </div>
        </section>

    </div>

    <!-- NOTE -->
    <p class="notice">
        Les informations d'aéroport et de livraison des bagages sont indicatives
        et doivent être confirmées sur place.
    </p>

</main>

</body>
</html>