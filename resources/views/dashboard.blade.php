<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon tableau de bord | FLIGHT MANAGER</title>

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
            --badge-green-bg: #dcfce7;
            --badge-green-text: #15803d;
            --badge-amber-bg: #fef3c7;
            --badge-amber-text: #b45309;
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
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            height: 68px;
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 20;
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
            padding: 28px 24px 48px;
        }

        /* ===== GREETING HEADER ===== */
        .greeting-bar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 22px;
        }

        .greeting-bar h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .greeting-bar p {
            font-size: 13px;
            color: var(--text-muted);
        }

        .logout-form {
            flex-shrink: 0;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            border: none;
            color: var(--logout-red);
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            padding: 6px 8px;
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
            padding: 22px 26px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        /* ===== NEXT TRIP BANNER ===== */
        .next-trip-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .next-trip-eyebrow {
            font-size: 12px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
        }

        .route-row {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 6px;
        }

        .city-code {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.4px;
            color: var(--text-main);
        }

        .route-plane {
            color: var(--blue);
            font-size: 16px;
            display: inline-flex;
            align-items: center;
        }

        .flight-meta {
            font-size: 12px;
            color: var(--text-muted);
        }

        .next-trip-right {
            display: flex;
            align-items: center;
            gap: 18px;
            flex-shrink: 0;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-confirmed {
            background: var(--badge-green-bg);
            color: var(--badge-green-text);
        }

        .badge-pending {
            background: var(--badge-amber-bg);
            color: var(--badge-amber-text);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 38px;
            padding: 0 18px;
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

        /* ===== MIDDLE TWO-COLUMN GRID ===== */
        .middle-grid {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 16px;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .action-tile {
            display: block;
            padding: 15px 16px;
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            background: #ffffff;
            transition: border-color 0.2s, box-shadow 0.2s, transform 0.15s;
        }

        .action-tile:hover {
            border-color: #b7d0ec;
            box-shadow: 0 6px 16px rgba(24, 95, 168, 0.08);
            transform: translateY(-1px);
        }

        .action-tile h3 {
            font-size: 13px;
            font-weight: 700;
            color: var(--blue);
            margin-bottom: 4px;
        }

        .action-tile p {
            font-size: 11px;
            color: var(--text-muted);
            line-height: 1.4;
        }

        /* ===== RECENT RESERVATIONS TABLE ===== */
        .reservations-table {
            width: 100%;
            border-collapse: collapse;
        }

        .reservations-table th {
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-soft);
        }

        .reservations-table td {
            padding: 14px 4px;
            font-size: 12.5px;
            border-bottom: 1px solid #f0f4f8;
            vertical-align: middle;
        }

        .reservations-table tr:last-child td {
            border-bottom: none;
            padding-bottom: 4px;
        }

        .ref-code {
            font-weight: 700;
            color: var(--text-main);
        }

        .route-text {
            color: #33475b;
        }

        /* ===== HELP BANNER ===== */
        .help-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .help-card h2 {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .help-card p {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .middle-grid {
                grid-template-columns: 1fr;
            }

            .next-trip-card,
            .help-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .next-trip-right {
                width: 100%;
                justify-content: space-between;
            }
        }

        @media (max-width: 720px) {
            .topbar {
                padding: 0 16px;
                height: auto;
                min-height: 64px;
                flex-wrap: wrap;
                padding-top: 10px;
                padding-bottom: 10px;
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

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .greeting-bar h1 {
                font-size: 22px;
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
                <a href="#reservations">Mes réservations</a>
                <a href="#voyages">Mes voyages</a>
            </nav>

            <a href="{{ route('dashboard') }}" class="account-pill">Mon compte</a>
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main class="page-container">

        <!-- BONJOUR + DECONNEXION -->
        <div class="greeting-bar">
            <div>
                <h1>Bonjour, {{ optional(auth()->user())->name ?? 'Irene' }} !</h1>
                <p>Bienvenue dans votre espace personnel. Préparez et suivez vos voyages en toute simplicité.</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>
        </div>

        
        <!-- PROCHAIN VOYAGE -->
<section class="card next-trip-card" id="voyages">

    @if($nextTrip && $nextTrip->flight)

        <div>
            <div class="next-trip-eyebrow">Votre prochain voyage</div>

            <div class="route-row">
                <span class="city-code">
                    {{ $nextTrip->flight->departureAirport->city ?? 'Départ' }}
                </span>

                <span class="route-plane" aria-hidden="true">✈</span>

                <span class="city-code">
                    {{ $nextTrip->flight->arrivalAirport->city ?? 'Arrivée' }}
                </span>
            </div>

            <div class="flight-meta">
                {{ $nextTrip->flight->departure_at->format('d/m/Y à H:i') }}
                • Vol {{ $nextTrip->flight->flight_number }}
                • Réservation {{ $nextTrip->reference }}
            </div>
        </div>

        <div class="next-trip-right">

            <span class="badge
                {{ $nextTrip->status === 'confirmed' ? 'badge-confirmed' : 'badge-pending' }}">
                {{ $nextTrip->status === 'confirmed' ? 'Confirmé' : 'En attente' }}
            </span>

            <a href="#reservations" class="btn-primary">
                Voir ma réservation
            </a>

        </div>

    @else

        <div>
            <div class="next-trip-eyebrow">Votre prochain voyage</div>

            <div class="route-row">
                <span class="city-code">✈️</span>
                <span class="city-code">Aucun voyage prévu</span>
            </div>

            <div class="flight-meta">
                Vous n'avez pas encore de réservation pour un vol à venir.
            </div>
        </div>

        <div class="next-trip-right">
            <a href="{{ route('vols.recherche') }}" class="btn-primary">
                Rechercher un vol
            </a>
        </div>

    @endif

</section>

        <!-- ACTIONS RAPIDES + RESERVATIONS RECENTES -->
        <div class="middle-grid">

            <!-- QUE SOUHAITEZ-VOUS FAIRE ? -->
            <section class="card">
                <h2 class="card-title">Que souhaitez-vous faire ?</h2>

                <div class="actions-grid">
                    <a href="{{ route('vols.recherche') }}" class="action-tile">
                        <h3>Rechercher un vol</h3>
                        <p>Trouvez votre prochaine destination</p>
                    </a>

                    
                    <a href="{{ route('bagages.index') }}" class="action-tile">
    <h3>Gérer mes bagages</h3>
                        <p>Ajoutez ou consultez vos bagages</p>
</a>

                    <a href="#enregistrement" class="action-tile">
                        <h3>M'enregistrer</h3>
                        <p>Effectuez votre check-in en ligne</p>
                    </a>

                    <a href="#suivi" class="action-tile">
                        <h3>Suivre un vol</h3>
                        <p>Consultez le statut de votre vol</p>
                    </a>
                </div>
            </section>

           
            <!-- MES RESERVATIONS RECENTES -->
<section class="card" id="reservations">

    <h2 class="card-title">Mes réservations récentes</h2>

    <table class="reservations-table">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Trajet</th>
                <th>Statut</th>
            </tr>
        </thead>

        <tbody>

            @forelse($recentReservations as $reservation)

                <tr>
                    <td class="ref-code">
                        {{ $reservation->reference }}
                    </td>

                    <td class="route-text">
                        @if($reservation->flight)
                            {{ $reservation->flight->departureAirport->city ?? 'Départ' }}
                            →
                            {{ $reservation->flight->arrivalAirport->city ?? 'Arrivée' }}
                        @else
                            Vol indisponible
                        @endif
                    </td>

                    <td>
                        @php
                            $status = strtolower($reservation->status);
                        @endphp

                        <span class="badge
                            {{ in_array($status, ['confirmed', 'confirmée', 'confirmee']) ? 'badge-confirmed' : 'badge-pending' }}">

                            @switch($status)
                                @case('confirmed')
                                @case('confirmee')
                                @case('confirmée')
                                    Confirmée
                                    @break

                                @case('cancelled')
                                @case('canceled')
                                @case('annulee')
                                @case('annulée')
                                    Annulée
                                    @break

                                @default
                                    En attente
                            @endswitch

                        </span>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="3" style="text-align: center; padding: 25px 5px; color: #718296;">
                        Vous n'avez pas encore effectué de réservation.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

</section>

        </div>

        <!-- BESOIN D'AIDE ? -->
        <section class="card help-card">
            <div>
                <h2>Besoin d'aide ?</h2>
                <p>Retrouvez les informations de votre réservation ou consultez votre historique de voyages.</p>
            </div>

            <a href="#reservations" class="btn-primary">Consulter mes voyages</a>
        </section>

    </main>

</body>
</html>