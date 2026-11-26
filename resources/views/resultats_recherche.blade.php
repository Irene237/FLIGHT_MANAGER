<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Résultats de recherche | FLIGHT MANAGER</title>

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
            margin-bottom: 6px;
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
            margin-bottom: 22px;
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

        /* ===== SEARCH SUMMARY BANNER ===== */

        .search-summary {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 20px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .summary-route h2 {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .summary-route p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .summary-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            padding: 0 22px;
            border-radius: 8px;
            background: #eef4fb;
            color: var(--blue);
            font-size: 12.5px;
            font-weight: 700;
            border: 1px solid #d9e6f5;
            transition: background 0.2s;
            white-space: nowrap;
        }

        .btn-secondary:hover {
            background: #dceafa;
        }

        /* ===== FLIGHT RESULT CARDS ===== */

        .flight-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 24px 28px;
            margin-bottom: 16px;
            display: grid;
            grid-template-columns: 95px 120px 95px 1.2fr 1fr auto;
            align-items: center;
            gap: 18px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.025);
        }

        .time-col strong {
            display: block;
            font-size: 18px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .time-col span {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .duration-col {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            color: var(--blue);
            white-space: nowrap;
        }

        .airline-col {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .price-col {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            white-space: nowrap;
        }

        .action-col {
            display: flex;
            justify-content: flex-end;
        }

        .choose-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            min-width: 132px;
            padding: 0 20px;
            background: var(--blue);
            color: #ffffff;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            white-space: nowrap;
            transition: background 0.2s;
        }

        .choose-btn:hover {
            background: var(--blue-hover);
        }

        /* ===== FALLBACK MESSAGE ===== */

        .alternative-message {
            background: #eef6ff;
            border: 1px solid #cfe3fa;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .alternative-message h2 {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .alternative-message p {
            font-size: 13px;
            color: #52647a;
            line-height: 1.6;
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
            font-size: 38px;
            margin-bottom: 12px;
        }

        .empty-state h2 {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .empty-state p {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        /* ===== RESPONSIVE ===== */

        @media (max-width: 960px) {
            .flight-card {
                grid-template-columns: repeat(3, 1fr);
                row-gap: 16px;
            }

            .action-col {
                justify-content: flex-start;
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

            .search-summary {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-actions {
                width: 100%;
            }

            .summary-actions a {
                flex: 1;
            }

            .flight-card {
                grid-template-columns: 1fr 1fr;
            }

            .choose-btn {
                width: 100%;
            }

            .action-col {
                grid-column: 1 / -1;
            }
        }
    </style>
</head>

<body>

    @php
        $isAllFlightsPage = $isAllFlightsPage ?? false;
        $isFallback = $isFallback ?? false;

        $departureAirport = !empty($searchData['departure_airport_id'])
            ? \App\Models\Airport::find($searchData['departure_airport_id'])
            : null;

        $arrivalAirport = !empty($searchData['arrival_airport_id'])
            ? \App\Models\Airport::find($searchData['arrival_airport_id'])
            : null;

        $formattedDate = !empty($searchData['departure_date'])
            ? \Carbon\Carbon::parse($searchData['departure_date'])->locale('fr')->translatedFormat('d F Y')
            : '';

        $passengersCount = (int) ($searchData['passengers'] ?? 1);

        $cabinLabels = [
            'economique' => 'Économique',
            'affaires' => 'Affaires',
            'premiere' => 'Première',
        ];

        $cabinLabel = $cabinLabels[$searchData['cabin_class'] ?? 'economique'] ?? 'Économique';
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

                <a href="{{ route('vols.recherche') }}" class="active">
                    Rechercher un vol
                </a>

                <a href="{{ route('vols.disponibles') }}">
                    Tous les vols
                </a>

                @auth
                    <a href="{{ route('reservations.index') }}">
                        Mes réservations
                    </a>

                    <a href="{{ route('voyages.index') }}">
                        Mes voyages
                    </a>
                @endauth

            </nav>

            @auth
                <a href="{{ route('dashboard') }}" class="account-pill">
                    Mon compte
                </a>
            @else
                <a href="{{ route('connexion') }}" class="account-pill">
                    Connexion
                </a>
            @endauth

        </div>

    </header>

    <main class="page-container">

        <!-- DECONNEXION -->

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

        <div class="page-heading">

            @if($isAllFlightsPage)

                <h1>Tous les vols disponibles</h1>

                <p>
                    Consultez les vols programmés et choisissez votre destination.
                </p>

            @elseif($isFallback)

                <h1>Aucun résultat exact</h1>

                <p>
                    Nous vous proposons d'autres vols disponibles dans notre programme.
                </p>

            @else

                <h1>Résultats de recherche</h1>

                <p>
                    Vols disponibles :

                    {{ $departureAirport?->city ?? 'Départ' }}
                    ({{ $departureAirport?->code ?? '---' }})

                    →

                    {{ $arrivalAirport?->city ?? 'Arrivée' }}
                    ({{ $arrivalAirport?->code ?? '---' }})

                    @if($formattedDate)
                        • {{ $formattedDate }}
                    @endif
                </p>

            @endif

        </div>

        <!-- RESUME DE LA RECHERCHE -->

        <section class="search-summary">

            <div class="summary-route">

                @if($isAllFlightsPage)

                    <h2>Programme des vols</h2>

                    <p>
                        Consultez tous les vols actuellement disponibles.
                    </p>

                @else

                    <h2>
                        {{ $departureAirport?->city ?? 'Départ' }}

                        →

                        {{ $arrivalAirport?->city ?? 'Arrivée' }}
                    </h2>

                    <p>

                        @if($formattedDate)
                            {{ $formattedDate }} •
                        @endif

                        {{ $passengersCount }}

                        {{ $passengersCount > 1 ? 'passagers' : 'passager' }}

                        • {{ $cabinLabel }}

                    </p>

                @endif

            </div>

            <div class="summary-actions">

                <a href="{{ route('vols.recherche') }}" class="btn-primary">
                    Nouvelle recherche
                </a>

                @unless($isAllFlightsPage)
                    <a href="{{ route('vols.disponibles') }}" class="btn-secondary">
                        Tous les vols
                    </a>
                @endunless

            </div>

        </section>

        <!-- MESSAGE SI AUCUN RESULTAT EXACT -->

        @if($isFallback && $flights->isNotEmpty())

            <section class="alternative-message">

                <h2>
                    Aucun vol ne correspond exactement à votre recherche.
                </h2>

                <p>
                    Nous n'avons pas trouvé de vol correspondant à votre trajet
                    et à la date sélectionnée. Voici d'autres vols disponibles
                    que vous pouvez consulter.
                </p>

            </section>

        @endif

        <!-- LISTE DES VOLS -->

        @forelse($flights as $flight)

            @php
                $depTime = \Carbon\Carbon::parse($flight->departure_at);
                $arrTime = \Carbon\Carbon::parse($flight->arrival_at);

                $totalMinutes = $depTime->diffInMinutes($arrTime);

                $hours = intdiv($totalMinutes, 60);

                $minutes = str_pad(
                    (string) ($totalMinutes % 60),
                    2,
                    '0',
                    STR_PAD_LEFT
                );
            @endphp

            <article class="flight-card">

                <!-- HEURE DEPART -->

                <div class="time-col">

                    <strong>
                        {{ $depTime->format('H:i') }}
                    </strong>

                    <span>
                        {{ $flight->departureAirport?->code }}
                    </span>

                </div>

                <!-- DUREE -->

                <div class="duration-col">

                    <span aria-hidden="true">✈</span>

                    <span>
                        {{ $hours }} h {{ $minutes }}
                    </span>

                </div>

                <!-- HEURE ARRIVEE -->

                <div class="time-col">

                    <strong>
                        {{ $arrTime->format('H:i') }}
                    </strong>

                    <span>
                        {{ $flight->arrivalAirport?->code }}
                    </span>

                </div>

                <!-- COMPAGNIE / AVION -->

                <div class="airline-col">

                    {{ $flight->airline ?? $flight->aircraft?->model ?? 'Flight Manager Air' }}

                    <br>

                    <small>
                        {{ $flight->flight_number }}
                    </small>

                </div>

                <!-- PRIX -->

                <div class="price-col">

                    {{ number_format($flight->price, 0, ',', ' ') }} FCFA

                    <br>

                    <small style="font-size: 11px; color: #718296; font-weight: 500;">
                        {{ $flight->available_seats }} places disponibles
                    </small>

                </div>

                <!-- ACTION -->

                <div class="action-col">

                    <a href="{{ route('reservations.create', $flight->id) }}"
                       class="choose-btn">

                        Choisir ce vol

                    </a>

                </div>

            </article>

        @empty

            <section class="empty-state">

                <div class="empty-icon">✈️</div>

                <h2>
                    Aucun vol disponible pour le moment
                </h2>

                <p>
                    Aucun vol ne correspond à votre recherche et aucun autre vol
                    n'est actuellement disponible dans notre programme.
                    Essayez une autre date ou consultez notre programme ultérieurement.
                </p>

                <a href="{{ route('vols.recherche') }}" class="btn-primary">
                    Rechercher un vol
                </a>

            </section>

        @endforelse

    </main>

</body>
</html>