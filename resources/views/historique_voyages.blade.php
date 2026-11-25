<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique de mes voyages | FLIGHT MANAGER</title>

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
            --badge-blue-bg: #e6f0fa;
            --badge-blue-text: #185fa8;
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

        /* ===== SECTION BANNER CARD ===== */
        .section-banner-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 22px 28px;
            margin-bottom: 18px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .section-banner-card h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .section-banner-card p {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ===== TRIP STRIP CARDS ===== */
        .trips-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .trip-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 22px 28px;
            display: grid;
            grid-template-columns: 1.5fr 0.7fr auto auto;
            align-items: center;
            gap: 24px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.025);
        }

        .trip-route-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .trip-date {
            font-size: 12px;
            color: var(--text-muted);
        }

        .trip-ref {
            font-size: 12px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: 0.2px;
            white-space: nowrap;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 14px;
            border-radius: 999px;
            background: var(--badge-blue-bg);
            color: var(--badge-blue-text);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .btn-details {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 128px;
            height: 38px;
            padding: 0 18px;
            border-radius: 8px;
            background: var(--blue);
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-details:hover {
            background: var(--blue-hover);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 52px 24px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.025);
        }

        .empty-icon {
            font-size: 42px;
            margin-bottom: 12px;
        }

        .empty-state h3 {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .empty-state p {
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 860px) {
            .trip-card {
                grid-template-columns: 1fr auto;
                gap: 14px 20px;
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

            .trip-card {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .btn-details {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<!-- BARRE DE NAVIGATION -->
<header class="topbar">
    <a href="{{ route('accueil') }}" class="brand">
    <span style="font-size: 22px;">✈️</span>
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

    <!-- EN-TETE -->
    <section class="page-heading">
        <h1>Historique de mes voyages</h1>
        <p>Retrouvez les voyages que vous avez déjà effectués.</p>
    </section>

    <!-- CARTE INTRODUCTION -->
    <section class="section-banner-card">
        <h2>Voyages passés</h2>
        <p>Consultez les détails de vos anciens trajets et billets.</p>
    </section>

    <!-- LISTE DES VOYAGES -->
    @if($pastTrips->isNotEmpty())
        <div class="trips-list">
            @foreach($pastTrips as $trip)
                @if($trip->flight)
                    @php
                        $departureCity = $trip->flight->departureAirport->city ?? 'Départ';
                        $arrivalCity = $trip->flight->arrivalAirport->city ?? 'Arrivée';
                        $tripDate = \Carbon\Carbon::parse($trip->flight->departure_at)
                            ->locale('fr')
                            ->translatedFormat('d F Y');
                    @endphp

                    <article class="trip-card">
                        <div>
                            <div class="trip-route-title">
                                {{ $departureCity }} → {{ $arrivalCity }}
                            </div>
                            <div class="trip-date">
                                {{ $tripDate }}
                            </div>
                        </div>

                        <div class="trip-ref">
                            {{ $trip->reference }}
                        </div>

                        <div>
                            <span class="status-badge">Voyage effectué</span>
                        </div>

                        <div>
                            <a href="{{ route('voyages.details', $trip->id) }}" class="btn-details">
    Voir les détails
</a>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">✈️</div>
            <h3>Aucun voyage effectué</h3>
            <p>
                Vous n'avez pas encore de voyage terminé.
                Vos futurs voyages apparaîtront ici une fois effectués.
            </p>
            <a href="{{ route('vols.recherche') }}" class="btn-details">
                Rechercher un vol
            </a>
        </div>
    @endif

</main>

</body>
</html>