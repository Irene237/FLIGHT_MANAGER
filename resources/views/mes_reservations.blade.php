<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations | FLIGHT MANAGER</title>

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
            --teal-btn: #166f9a;
            --teal-btn-hover: #11587a;
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #102a43;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --input-border: #dce4ee;
            --logout-red: #dc3545;
            --badge-green-bg: #dcfce7;
            --badge-green-text: #15803d;
            --badge-amber-bg: #fef3c7;
            --badge-amber-text: #b45309;
            --badge-red-bg: #fee2e2;
            --badge-red-text: #b91c1c;
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

        button, select {
            font-family: inherit;
        }

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

        .alert {
            padding: 12px 16px;
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

        .filter-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 20px 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 18px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .filter-card h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .filter-card p {
            font-size: 12px;
            color: var(--text-muted);
        }

        .filter-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .filter-select {
            min-width: 190px;
            height: 38px;
            border: 1px solid var(--input-border);
            border-radius: 8px;
            padding: 0 12px;
            background: #f8fafc;
            color: var(--text-main);
            font-size: 12.5px;
            font-weight: 500;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: var(--blue);
        }

        .reservation-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 20px 26px;
            margin-bottom: 16px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.025);
        }

        .reservation-main {
            display: grid;
            grid-template-columns: 1.35fr 0.9fr auto auto;
            align-items: center;
            gap: 20px;
        }

        .ref-text {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.3px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .route-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--text-main);
        }

        .flight-date-col {
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge.confirmed {
            background: var(--badge-green-bg);
            color: var(--badge-green-text);
        }

        .badge.pending {
            background: var(--badge-amber-bg);
            color: var(--badge-amber-text);
        }

        .badge.cancelled {
            background: var(--badge-red-bg);
            color: var(--badge-red-text);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .btn-detail,
        .btn-ticket,
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 96px;
            min-height: 36px;
            padding: 0 16px;
            border-radius: 8px;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background 0.2s, color 0.2s;
            white-space: nowrap;
        }

        .btn-detail {
            background: var(--blue);
        }

        .btn-detail:hover {
            background: var(--blue-hover);
        }

        .btn-ticket {
            background: var(--teal-btn);
        }

        .btn-ticket:hover {
            background: var(--teal-btn-hover);
        }

        .cancel-form {
            display: inline-flex;
            margin: 0;
        }

        .btn-cancel {
            background: #fff1f0;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .btn-cancel:hover {
            background: #dc2626;
            color: white;
            border-color: #dc2626;
        }

        .reservation-details {
            display: none;
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #eef2f7;
        }

        .reservation-details.open {
            display: block;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 14px;
        }

        .detail-item span {
            display: block;
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .detail-item strong {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-main);
        }

        .details-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 12.5px;
            color: #52647a;
        }

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

        .empty-state h2 {
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

        .pagination {
            margin-top: 22px;
        }

        .no-filter-result {
            display: none;
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .reservation-main {
                grid-template-columns: 1fr auto;
            }

            .flight-date-col {
                text-align: left;
            }

            .details-grid {
                grid-template-columns: repeat(2, 1fr);
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

            .filter-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-controls {
                width: 100%;
                flex-wrap: wrap;
            }

            .filter-select {
                flex: 1;
            }

            .reservation-main {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .actions {
                justify-content: flex-start;
            }
        }

        @media (max-width: 450px) {
            .details-grid {
                grid-template-columns: 1fr 1fr;
            }

            .filter-select {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>

<header class="topbar">

    <a href="{{ route('accueil') }}" class="brand">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="#185fa8"/>
        </svg>
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

    <div class="page-heading">
        <h1>Mes réservations</h1>
        <p>Consultez et gérez vos réservations en cours et à venir.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->has('reservation'))
        <div class="alert alert-error">
            {{ $errors->first('reservation') }}
        </div>
    @endif

    <section class="filter-card">

        <div>
            <h2>Toutes mes réservations ({{ $reservations->total() }})</h2>
            <p>Retrouvez les détails, les billets et les options de gestion.</p>
        </div>

        <div class="filter-controls">
            <select id="statusFilter" class="filter-select" aria-label="Filtrer par statut">
                <option value="all">Toutes les réservations</option>
                <option value="confirmed">Confirmées</option>
                <option value="pending">En attente</option>
                <option value="cancelled">Annulées</option>
            </select>
        </div>

    </section>

    @forelse($reservations as $reservation)

        @php
            $flight = $reservation->flight;
            $departure = $flight?->departureAirport;
            $arrival = $flight?->arrivalAirport;

            $status = strtolower($reservation->status ?? '');

            $statusClass = match($status) {
                'confirmed' => 'confirmed',
                'pending' => 'pending',
                'cancelled', 'canceled', 'annulee', 'annulée' => 'cancelled',
                default => 'other'
            };

            $statusLabel = match($status) {
                'confirmed' => 'Confirmée',
                'pending' => 'En attente',
                'cancelled', 'canceled', 'annulee', 'annulée' => 'Annulée',
                default => ucfirst($reservation->status ?? 'Inconnu')
            };

            $formattedFlightDate = $flight?->departure_at
                ? \Carbon\Carbon::parse($flight->departure_at)->locale('fr')->translatedFormat('d F Y')
                : 'Date non renseignée';

            $successfulPayment = $reservation->payments
                ->where('status', 'successful')
                ->sortByDesc('paid_at')
                ->first();
        @endphp

        <article class="reservation-card" data-status="{{ $statusClass }}">

            <div class="reservation-main">

                <div>
                    <div class="ref-text">
                        {{ $reservation->reference }}
                    </div>

                    <div class="route-title">
                        {{ $departure?->city ?? 'Départ' }}
                        →
                        {{ $arrival?->city ?? 'Arrivée' }}
                    </div>
                </div>

                <div class="flight-date-col">
                    {{ $formattedFlightDate }}
                </div>

                <div>
                    <span class="badge {{ $statusClass === 'other' ? 'pending' : $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="actions">

                    <button
                        type="button"
                        class="btn-detail"
                        onclick="toggleDetails('details-{{ $reservation->id }}')"
                        aria-expanded="false"
                        aria-controls="details-{{ $reservation->id }}"
                    >
                        Détails
                    </button>

                    @if($status === 'pending')

                        <a href="{{ route('paiements.create', $reservation) }}" class="btn-ticket">
                            Payer
                        </a>

                        <form
                            action="{{ route('reservations.cancel', $reservation) }}"
                            method="POST"
                            class="cancel-form"
                            onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ? Les places seront remises en disponibilité.');"
                        >
                            @csrf

                            <button type="submit" class="btn-cancel">
                                Annuler
                            </button>
                        </form>

                    @elseif($status === 'confirmed' && $successfulPayment)

                        <a href="{{ route('paiements.pdf', $reservation) }}" class="btn-ticket">
                            Billet
                        </a>

                    @endif

                </div>

            </div>

            <div id="details-{{ $reservation->id }}" class="reservation-details">

                <div class="details-grid">

                    <div class="detail-item">
                        <span>Numéro du vol</span>
                        <strong>
                            {{ $flight?->flight_number ?? 'Non renseigné' }}
                        </strong>
                    </div>

                    <div class="detail-item">
                        <span>Heure de départ</span>
                        <strong>
                            {{ $flight?->departure_at
                                ? \Carbon\Carbon::parse($flight->departure_at)->format('H:i')
                                : '--:--' }}
                        </strong>
                    </div>

                    <div class="detail-item">
                        <span>Nombre de places</span>
                        <strong>{{ $reservation->number_of_seats }}</strong>
                    </div>

                    <div class="detail-item">
                        <span>Montant total</span>
                        <strong>
                            {{ number_format($reservation->total_amount, 0, ',', ' ') }} FCFA
                        </strong>
                    </div>

                </div>

                <div class="details-footer">

                    <div>
                        <strong>Passagers :</strong>

                        @forelse($reservation->passengers as $passenger)
                            {{ $passenger->first_name }}
                            {{ $passenger->last_name }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            Aucun passager enregistré.
                        @endforelse
                    </div>

                    @if($status === 'pending')
                        <a href="{{ route('paiements.create', $reservation) }}" class="btn-detail">
                            Procéder au paiement
                        </a>

                    @elseif($status === 'confirmed' && $successfulPayment)
                        <a href="{{ route('paiements.pdf', $reservation) }}" class="btn-ticket">
                            Télécharger le billet
                        </a>
                    @endif

                </div>

            </div>

        </article>

    @empty

        <div class="empty-state">

            <div class="empty-icon">✈️</div>

            <h2>Aucune réservation pour le moment</h2>

            <p>
                Vous n'avez pas encore réservé de vol.
                Recherchez une destination pour commencer votre voyage.
            </p>

            <a href="{{ route('vols.recherche') }}" class="btn-detail">
                Rechercher un vol
            </a>

        </div>

    @endforelse

    <div id="noFilterResult" class="no-filter-result">
        Aucune réservation ne correspond au statut sélectionné.
    </div>

    <div class="pagination">
        {{ $reservations->links() }}
    </div>

</main>

<script>
    function toggleDetails(id) {
        const panel = document.getElementById(id);

        if (panel) {
            panel.classList.toggle('open');

            const button = document.querySelector(
                '[aria-controls="' + id + '"]'
            );

            if (button) {
                button.setAttribute(
                    'aria-expanded',
                    panel.classList.contains('open')
                );
            }
        }
    }

    const statusFilter = document.getElementById('statusFilter');

    if (statusFilter) {
        statusFilter.addEventListener('change', function () {

            const selected = this.value;
            const cards = document.querySelectorAll('.reservation-card');

            let visibleCount = 0;

            cards.forEach(function (card) {

                const cardStatus = card.getAttribute('data-status');

                const shouldDisplay =
                    selected === 'all' || cardStatus === selected;

                card.style.display = shouldDisplay ? '' : 'none';

                if (shouldDisplay) {
                    visibleCount++;
                }
            });

            const noResult = document.getElementById('noFilterResult');

            if (noResult) {
                noResult.style.display =
                    visibleCount === 0 && cards.length > 0 ? 'block' : 'none';
            }
        });
    }
</script>

</body>
</html>