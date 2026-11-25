<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement en ligne (Check-in) | FLIGHT MANAGER</title>

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

        /* ===== ALERTS ===== */
        .alert {
            padding: 13px 16px;
            border-radius: 10px;
            margin-bottom: 18px;
            font-size: 13px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 26px 28px;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .card h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 16px;
        }

        /* ===== RESERVATION SELECTION LIST ===== */
        .reservation-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 8px 0;
        }

        .reservation-row + .reservation-row {
            margin-top: 14px;
            padding-top: 16px;
            border-top: 1px solid #eef2f7;
        }

        .res-summary-line {
            font-size: 13px;
            font-weight: 500;
            color: #334e68;
        }

        .res-actions {
            display: flex;
            align-items: center;
            gap: 28px;
            flex-shrink: 0;
        }

        .badge-open {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            padding: 5px 14px;
            border-radius: 999px;
            background: var(--badge-green-bg);
            color: var(--badge-green-text);
            font-size: 11px;
            font-weight: 700;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 136px;
            height: 40px;
            padding: 0 22px;
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

        .btn-primary:hover {
            background: var(--blue-hover);
        }

        /* ===== PASSENGERS DRAWER INSIDE SELECTION CARD ===== */
        .passengers-drawer {
            display: none;
            margin-top: 16px;
            padding: 16px 18px;
            background: #f8fafc;
            border: 1px solid #e6ecf3;
            border-radius: 10px;
        }

        .passengers-drawer.open {
            display: block;
        }

        .drawer-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .passenger-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 10px 0;
            border-top: 1px solid #e6ecf3;
        }

        .passenger-item:first-of-type {
            border-top: none;
            padding-top: 4px;
        }

        .passenger-name {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .passenger-sub {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .btn-boarding {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: 0 16px;
            border-radius: 8px;
            background: var(--badge-green-bg);
            color: var(--badge-green-text);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .btn-checkin-sm {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: 0 16px;
            border-radius: 8px;
            background: var(--blue);
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-checkin-sm:hover {
            background: var(--blue-hover);
        }

        /* ===== BEFORE STARTING CARD ===== */
        .checklist {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin: 18px 0 28px;
        }

        .checklist li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12.5px;
            color: #334e68;
        }

        .check-mark {
            color: #334e68;
            font-weight: 700;
            font-size: 13px;
        }

        .card-bottom-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding-top: 6px;
        }

        .airline-rule-note {
            font-size: 11px;
            color: var(--text-muted);
        }

        .btn-continue {
            min-width: 240px;
            height: 42px;
            padding: 0 24px;
        }

        /* ===== EMPTY STATE ===== */
        .empty-inline {
            font-size: 13px;
            color: var(--text-muted);
            padding: 6px 0;
        }

        .empty-inline a {
            color: var(--blue);
            font-weight: 700;
            margin-left: 6px;
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
                padding: 18px 14px 36px;
            }

            .reservation-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .res-actions {
                width: 100%;
                justify-content: space-between;
            }

            .passenger-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-continue {
                width: 100%;
            }
        }
    </style>
</head>

<body>

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
        <h1>Enregistrement en ligne (Check-in)</h1>
        <p>Enregistrez-vous avant le départ pour obtenir votre carte d'embarquement.</p>
    </section>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- CARTE 1 : SELECTIONNEZ UNE RESERVATION -->
    <section class="card">
        <h2>Sélectionnez une réservation</h2>

        @forelse($reservations as $reservation)
            @php
                $flight = $reservation->flight;
                $departure = $flight?->departureAirport;
                $arrival = $flight?->arrivalAirport;
                $formattedDate = $flight?->departure_at
                    ? \Carbon\Carbon::parse($flight->departure_at)->locale('fr')->translatedFormat('d F Y')
                    : '';
            @endphp

            @if($flight && $departure && $arrival)
                <div class="reservation-item">
                    <div class="reservation-row">
                        <div class="res-summary-line">
                            {{ $reservation->reference }} • {{ $departure->city }} → {{ $arrival->city }}
                            @if($formattedDate)
                                • {{ $formattedDate }}
                            @endif
                        </div>

                        <div class="res-actions">
                            <span class="badge-open">Ouvert</span>

                            <button
                                type="button"
                                class="btn-primary"
                                onclick="toggleCheckinDrawer('drawer-{{ $reservation->id }}')"
                            >
                                Commencer
                            </button>
                        </div>
                    </div>

                    <div id="drawer-{{ $reservation->id }}" class="passengers-drawer">
                        <div class="drawer-title">
                            Vol {{ $flight->flight_number }} · Départ à {{ $flight->departure_at->format('H:i') }} — Passagers à enregistrer
                        </div>

                        @foreach($reservation->passengers as $passenger)
                            @php
                                $checkIn = $passenger->checkIns->firstWhere('reservation_id', $reservation->id);
                            @endphp

                            <div class="passenger-item">
                                <div>
                                    <div class="passenger-name">
                                        {{ $passenger->first_name }} {{ $passenger->last_name }}
                                    </div>
                                    <div class="passenger-sub">
                                        @if($checkIn)
                                            Enregistré · Siège {{ $checkIn->seat_number }}
                                        @else
                                            En attente d'enregistrement
                                        @endif
                                    </div>
                                </div>

                                @if($checkIn)
                                    <a href="{{ route('checkin.boarding-pass', $checkIn) }}" class="btn-boarding">
                                        Voir la carte d'embarquement
                                    </a>
                                @else
                                    <form
                                        action="{{ route('checkin.store', [$reservation, $passenger]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Confirmer l’enregistrement de ce passager ?');"
                                    >
                                        @csrf
                                        <button type="submit" class="btn-checkin-sm">
                                            Enregistrer ce passager
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @empty
            <div class="empty-inline">
                Aucune réservation confirmée et payée disponible pour l'enregistrement.
                <a href="{{ route('reservations.index') }}">Voir mes réservations →</a>
            </div>
        @endforelse
    </section>

    <!-- CARTE 2 : AVANT DE COMMENCER -->
    <section class="card">
        <h2>Avant de commencer</h2>

        <ul class="checklist">
            <li>
                <span class="check-mark">✓</span>
                <span>Votre réservation doit être confirmée et payée.</span>
            </li>
            <li>
                <span class="check-mark">✓</span>
                <span>Préparez votre pièce d'identité ou votre passeport.</span>
            </li>
            <li>
                <span class="check-mark">✓</span>
                <span>Vérifiez l'orthographe de vos informations personnelles.</span>
            </li>
        </ul>

        <div class="card-bottom-row">
            <span class="airline-rule-note">
                L'enregistrement ouvre selon les règles de la compagnie aérienne.
            </span>

            @if($reservations->isNotEmpty())
                <button
                    type="button"
                    class="btn-primary btn-continue"
                    onclick="openFirstCheckinDrawer()"
                >
                    Continuer l'enregistrement
                </button>
            @else
                <a href="{{ route('reservations.index') }}" class="btn-primary btn-continue">
                    Continuer l'enregistrement
                </a>
            @endif
        </div>
    </section>

</main>

<script>
    function toggleCheckinDrawer(id) {
        const drawer = document.getElementById(id);
        if (drawer) {
            drawer.classList.toggle('open');
        }
    }

    function openFirstCheckinDrawer() {
        const firstDrawer = document.querySelector('.passengers-drawer');
        if (firstDrawer) {
            firstDrawer.classList.add('open');
            firstDrawer.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>

</body>
</html>