<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de votre vol | FLIGHT MANAGER</title>

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
            --line-color: #cbd5e1;
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

        /* ===== MAIN CONTAINER ===== */
        .page-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 24px 24px 50px;
        }

        .heading-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 26px;
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

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 26px 30px;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .flight-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .flight-route-title {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-main);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 96px;
            padding: 5px 16px;
            border-radius: 999px;
            background: var(--green-bg);
            color: var(--green-text);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-pill.delayed {
            background: #fef3c7;
            color: #b45309;
        }

        .status-pill.cancelled {
            background: #fee2e2;
            color: #b91c1c;
        }

        .schedule-grid {
            display: grid;
            grid-template-columns: minmax(200px, 340px) minmax(200px, 340px);
            gap: 40px;
        }

        .schedule-label {
            display: block;
            font-size: 11.5px;
            font-weight: 500;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .schedule-value {
            font-size: 14.5px;
            font-weight: 800;
            color: var(--text-main);
        }

        /* ===== FLIGHT STATUS TRACKER ===== */
        .status-card-title {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 44px;
        }

        .tracker-wrapper {
            position: relative;
            max-width: 860px;
            margin: 0 auto 42px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .tracker-line {
            position: absolute;
            top: 22px;
            left: 65px;
            right: 65px;
            height: 3px;
            background: var(--line-color);
            z-index: 1;
        }

        .tracker-step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 140px;
        }

        .step-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
        }

        .step-circle.done {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .step-circle.current {
            background: #e6f0fa;
            color: var(--blue);
        }

        .step-circle.upcoming {
            background: #f1f5f9;
            color: #94a3b8;
        }

        .step-label {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-main);
        }

        .demo-note {
            font-size: 11px;
            color: var(--text-muted);
        }

        .info-message {
            padding: 12px 14px;
            border-radius: 8px;
            background: #f1f6fc;
            color: #52647a;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 16px;
        }

        /* ===== RESPONSIVE ===== */
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
                padding: 20px 14px 36px;
            }

            .card {
                padding: 22px 20px;
            }

            .flight-card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .tracker-line {
                left: 44px;
                right: 44px;
            }

            .tracker-step {
                width: 98px;
            }

            .step-label {
                font-size: 10.5px;
            }
        }
    </style>
</head>

<body>

@php
    $depFormatted = \Carbon\Carbon::parse($flight->departure_at)->locale('fr')->translatedFormat('d M Y');
    $arrFormatted = \Carbon\Carbon::parse($flight->arrival_at)->locale('fr')->translatedFormat('d M Y');
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

        <a href="{{ route('dashboard') }}" class="account-pill">Mon compte</a>
    </div>
</header>

<main class="page-container">

    <!-- EN-TETE + DECONNEXION -->
    <div class="heading-row">
        <div class="page-heading">
            <h1>Suivi de votre vol</h1>
            <p>Consultez le statut et les horaires de votre vol.</p>
        </div>

        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>
        @endauth
    </div>

    <!-- CARTE 1 : DETAILS DU VOL -->
    <section class="card">
        <div class="flight-card-header">
            <h2 class="flight-route-title">
                {{ $flight->flight_number }}
                •
                {{ $flight->departureAirport->city }} ({{ $flight->departureAirport->code }})
                →
                {{ $flight->arrivalAirport->city }} ({{ $flight->arrivalAirport->code }})
            </h2>

            <span class="status-pill {{ $flightStageClass ?? '' }}">
                {{ $statusLabel ?? "À l'heure" }}
            </span>
        </div>

        <div class="schedule-grid">
            <div>
                <span class="schedule-label">Départ prévu</span>
                <div class="schedule-value">
                    {{ \Carbon\Carbon::parse($flight->departure_at)->format('H:i') }}
                    •
                    {{ $depFormatted }}
                </div>
            </div>

            <div>
                <span class="schedule-label">Arrivée prévue</span>
                <div class="schedule-value">
                    {{ \Carbon\Carbon::parse($flight->arrival_at)->format('H:i') }}
                    •
                    {{ $arrFormatted }}
                </div>
            </div>
        </div>
    </section>

    <!-- CARTE 2 : ETAT DU VOL -->
    <section class="card">
        <h2 class="status-card-title">État du vol</h2>

        <div class="tracker-wrapper">
            <div class="tracker-line" aria-hidden="true"></div>

            @foreach ($steps as $step)
                <div class="tracker-step">
                    <div class="step-circle {{ $step['done'] ? 'done' : ($step['current'] ? 'current' : 'upcoming') }}">
                        @if ($step['done'])
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.6"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        @elseif ($step['key'] === 'preparation')
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="1.9"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z"/>
                            </svg>
                        @else
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="6"></circle>
                                <line x1="12" y1="2" x2="12" y2="6"></line>
                                <line x1="12" y1="18" x2="12" y2="22"></line>
                                <line x1="2" y1="12" x2="6" y2="12"></line>
                                <line x1="18" y1="12" x2="22" y2="12"></line>
                            </svg>
                        @endif
                    </div>

                    <span class="step-label">{{ $step['label'] }}</span>
                </div>
            @endforeach
        </div>

        <p class="demo-note">
    Le statut du vol est déterminé à partir des horaires prévus et des enregistrements des passagers.
</p>

        @if (isset($hasCheckedIn) && !$hasCheckedIn)
            <div class="info-message">
                Vous n'avez pas encore effectué votre enregistrement en ligne.
                Pensez à le faire avant votre départ.
            </div>
        @endif
    </section>

</main>

</body>
</html>