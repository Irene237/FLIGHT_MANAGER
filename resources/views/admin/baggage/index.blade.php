<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des bagages | FLIGHT MANAGER</title>

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
            --sidebar-bg: #0c233c;
            --sidebar-active: #1d4ed8;
            --sidebar-hover: rgba(255,255,255,.06);
            --bg-page: #f5f7fa;
            --surface: #fff;
            --text-main: #0f294a;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --input-border: #dce4ee;
            --blue: #1d5fd6;
            --blue-hover: #1749a8;
            --logout-bg: #fee2e2;
            --logout-text: #dc2626;
            --badge-blue-bg: #e0e7ff;
            --badge-blue-text: #1d4ed8;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --amber-bg: #fef3c7;
            --amber-text: #b45309;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
        }

        a { text-decoration: none; color: inherit; }
        button, input, select { font-family: inherit; }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 224px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            padding: 20px 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            z-index: 30;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 4px 8px 24px;
        }

        .brand-mark {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #13385e;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .brand-text strong {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .3px;
        }

        .brand-text span {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 1px;
            color: #93a8be;
            margin-top: 2px;
        }

        .nav-group-label {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: .8px;
            color: #7d93ab;
            text-transform: uppercase;
            padding: 12px 10px 8px;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: 7px;
            font-size: 11.5px;
            font-weight: 500;
            color: #cbd5e1;
            transition: .18s;
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: #fff;
        }

        .nav-item.active {
            background: var(--sidebar-active);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-footer {
            padding-top: 16px;
            margin-top: 16px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .control-center-link {
            display: block;
            padding: 6px 10px;
            font-size: 11.5px;
            font-weight: 700;
            color: #f8fafc;
            border-radius: 6px;
        }

        .control-center-link:hover {
            background: var(--sidebar-hover);
        }

        /* MAIN */
        .main-wrapper {
            margin-left: 224px;
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .topbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .breadcrumb {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.3px;
            color: var(--text-main);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .search-icon-btn {
            background: transparent;
            border: none;
            color: #64748b;
            cursor: pointer;
            display: inline-flex;
            padding: 6px;
            border-radius: 6px;
        }

        .search-icon-btn:hover { background: #f1f5f9; }

        .admin-badge {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .admin-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e6f0fa;
            color: var(--blue);
            font-size: 10.5px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .admin-meta strong {
            display: block;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .admin-meta span {
            display: block;
            font-size: 9.5px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--logout-bg);
            color: var(--logout-text);
            border: none;
            border-radius: 6px;
            padding: 7px 12px;
            font-size: 10.5px;
            font-weight: 700;
            cursor: pointer;
            white-space: nowrap;
        }

        .logout-btn:hover { background: #fecaca; }

        /* CONTENT */
        .content { padding: 20px 28px 38px; }

        .page-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .alert-success,
        .alert-error {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 12px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-error ul {
            margin: 7px 0 0 18px;
        }

        /* CARDS */
        .panel-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 20px 22px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .card-title {
            font-size: 13px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 3px;
        }

        .card-subtitle {
            font-size: 10.5px;
            color: var(--text-muted);
        }

        /* FORMULAIRES */
        .filter-grid {
            display: grid;
            grid-template-columns: repeat(3,minmax(150px,1fr)) auto;
            gap: 12px;
            align-items: end;
            margin-top: 14px;
        }

        .field-group label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            color: #334e68;
            margin-bottom: 5px;
        }

        .field-input,
        .field-select {
            width: 100%;
            height: 36px;
            border: 1px solid var(--input-border);
            border-radius: 7px;
            padding: 0 11px;
            background: #fff;
            color: var(--text-main);
            font-size: 11px;
            outline: none;
        }

        .field-input::placeholder { color: #94a3b8; }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--blue);
        }

        .btn-blue {
            min-height: 36px;
            padding: 0 20px;
            border: none;
            border-radius: 7px;
            background: var(--blue);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-blue:hover { background: var(--blue-hover); }

        /* TABLEAU */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            margin-top: 14px;
        }

        .bag-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 780px;
            font-size: 11px;
        }

        .bag-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            color: var(--text-muted);
            text-transform: uppercase;
            background: #f8fafc;
            padding: 10px 12px;
        }

        .bag-table thead th:first-child {
            border-radius: 5px 0 0 5px;
        }

        .bag-table thead th:last-child {
            border-radius: 0 5px 5px 0;
        }

        .bag-table tbody td {
            padding: 13px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            vertical-align: middle;
            white-space: nowrap;
        }

        .bag-table tbody tr:last-child td { border-bottom: none; }

        .bag-ref {
            font-weight: 700;
            color: var(--text-main);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 72px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 700;
        }

        .status-badge.registered {
            background: var(--badge-blue-bg);
            color: var(--badge-blue-text);
        }

        .status-badge.loaded,
        .status-badge.authorized {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .status-badge.delayed {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .status-badge.flagged {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .action-dots-btn {
            background: transparent;
            border: none;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .action-dots-btn:hover {
            background: #f1f5f9;
            color: var(--text-main);
        }

        .bag-action-row {
            display: none;
            background: #f8fafc;
        }

        .bag-action-row.open { display: table-row; }

        .bag-action-box {
            padding: 9px 14px;
            font-size: 11px;
            color: #486581;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            white-space: normal;
        }

        .mini-link {
            color: var(--blue);
            font-weight: 700;
        }

        .mini-delete-btn {
            background: transparent;
            border: none;
            color: var(--red-text);
            font-weight: 700;
            cursor: pointer;
            font-size: 11px;
        }

        .incident-comment-display {
            color: #64748b;
            white-space: normal;
            max-width: 300px;
        }

        /* INCIDENT */
        .incident-box {
            margin-top: 24px;
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 18px 20px;
            background: #fff;
        }

        .incident-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1.5fr auto;
            gap: 12px;
            align-items: end;
            margin-top: 14px;
        }

        .pagination-container {
            margin-top: 16px;
            display: flex;
            justify-content: flex-end;
        }

        .field-error {
            display: block;
            color: #dc2626;
            font-size: 10px;
            margin-top: 5px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .filter-grid { grid-template-columns: 1fr 1fr; }

            .filter-grid .btn-blue {
                grid-column: span 2;
                justify-self: end;
            }

            .incident-grid { grid-template-columns: 1fr 1fr; }

            .incident-grid .btn-blue {
                grid-column: span 2;
                justify-self: end;
            }
        }

        @media (max-width: 768px) {
            body { flex-direction: column; }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-wrapper { margin-left: 0; }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                padding: 14px 18px;
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .content { padding: 16px 18px 28px; }

            .filter-grid,
            .incident-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid .btn-blue,
            .incident-grid .btn-blue {
                grid-column: span 1;
                width: 100%;
            }
        }
    </style>
</head>

<body>

@php
    $adminName = Auth::user()->name ?? 'Admin';
    $nameParts = preg_split('/\s+/', trim($adminName));

    $initials = strtoupper(
        substr($nameParts[0] ?? 'A', 0, 1) .
        (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : 'D')
    );

    $flightOptions = $baggages->getCollection()
        ->map(fn($b) => $b->reservation?->flight?->flight_number)
        ->filter()
        ->unique()
        ->values();
@endphp

<!-- SIDEBAR -->
<aside class="sidebar">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="#38bdf8"/>
                </svg>
            </span>
            <span class="brand-text">
                <strong>FLIGHT</strong>
                <span>MANAGER</span>
            </span>
        </a>

        <div class="nav-group-label">MENU PRINCIPAL</div>

        <nav class="nav-list" aria-label="Menu administration">

            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <span>⌂</span>
                <span>Vue d'ensemble</span>
            </a>

            <a href="{{ route('admin.flights.index') }}" class="nav-item">
                <span>✈</span>
                <span>Gestion des vols</span>
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="nav-item">
                <span>▣</span>
                <span>Avions &amp; destinations</span>
            </a>

            <a href="{{ route('admin.reservations.index') }}" class="nav-item">
                <span>▤</span>
                <span>Réservations</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item">
                <span>♙</span>
                <span>Utilisateurs</span>
            </a>

            <a href="{{ route('admin.baggage.index') }}" class="nav-item active">
                <span>▣</span>
                <span>Bagages</span>
            </a>

            <a href="{{ route('admin.crew.index') }}" class="nav-item">
                <span>♧</span>
                <span>Équipages</span>
            </a>

          <a href="{{ route('admin.settings.index') }}" class="nav-item">
                <span>⚙</span>
                <span>Paramètres système</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="nav-group-label" style="padding-top:0;">ESPACE ADMINISTRATEUR</div>
        <a href="{{ route('admin.dashboard') }}" class="control-center-link">
            Centre de contrôle
        </a>
    </div>
</aside>

<!-- CONTENU PRINCIPAL -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">
        <div>
            <div class="breadcrumb">Administration / Gestion des bagages</div>
            <h1 class="topbar-title">Gestion des bagages</h1>
        </div>

        <div class="topbar-right">
            <button type="button" class="search-icon-btn" aria-label="Rechercher">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </button>

            <div class="admin-badge">
                <span class="admin-avatar">{{ $initials }}</span>
                <div class="admin-meta">
                    <strong>{{ $adminName }}</strong>
                    <span>Super administrateur</span>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>
        </div>
    </header>

    <main class="content">

        <p class="page-subtitle">
            Contrôlez l'enregistrement, le chargement et la livraison des bagages.
        </p>

        <!-- MESSAGE DE SUCCÈS -->
        @if(session('success'))
            <div class="alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- ERREURS DE VALIDATION -->
        @if($errors->any())
            <div class="alert-error">
                <strong>Une erreur est survenue :</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- CARTE 1 : RECHERCHE -->
        <section class="panel-card">

            <h2 class="card-title">Suivi des bagages</h2>
            <p class="card-subtitle">
                Retrouvez un bagage à partir de sa référence, du vol ou du nom du passager.
            </p>

            <form action="{{ route('admin.baggage.index') }}" method="GET" class="filter-grid">

                <div class="field-group">
                    <label for="search">Référence bagage</label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        class="field-input"
                        placeholder="BAG-00982"
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="field-group">
                    <label for="flight">Vol associé</label>
                    <select id="flight" name="flight" class="field-select">
                        <option value="">Tous les vols</option>

                        @foreach($flightOptions as $flightNum)
                            <option
                                value="{{ $flightNum }}"
                                {{ request('flight') === $flightNum ? 'selected' : '' }}
                            >
                                {{ $flightNum }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field-group">
                    <label for="status">État du bagage</label>
                    <select id="status" name="status" class="field-select">
                        <option value="">Tous</option>
                        <option value="registered" {{ request('status') === 'registered' ? 'selected' : '' }}>Enregistré</option>
                        <option value="loaded" {{ request('status') === 'loaded' ? 'selected' : '' }}>Chargé</option>
                        <option value="delivered" {{ request('status') === 'delivered' ? 'selected' : '' }}>Livré</option>
                        <option value="delayed" {{ request('status') === 'delayed' ? 'selected' : '' }}>Retardé</option>
                        <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Perdu</option>
                        <option value="damaged" {{ request('status') === 'damaged' ? 'selected' : '' }}>Endommagé</option>
                    </select>
                </div>

                <button type="submit" class="btn-blue">Rechercher</button>

            </form>
        </section>

        <!-- CARTE 2 : REGISTRE -->
        <section class="panel-card">

            <h2 class="card-title">Registre des bagages</h2>
            <p class="card-subtitle">
                Suivi des bagages enregistrés, chargés, livrés ou signalés.
            </p>

            <div class="table-responsive">

                <table class="bag-table">

                    <thead>
                        <tr>
                            <th>RÉFÉRENCE</th>
                            <th>PASSAGER</th>
                            <th>VOL</th>
                            <th>POIDS</th>
                            <th>TYPE</th>
                            <th>LOCALISATION</th>
                            <th>STATUT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($baggages as $baggage)

                            @php
                                $passenger = $baggage->passenger;

                                $passengerName = $passenger
                                    ? trim($passenger->first_name . ' ' . $passenger->last_name)
                                    : 'Passager indisponible';

                                $flightNumber = $baggage->reservation?->flight?->flight_number ?? '---';

                                $weightClean = rtrim(
                                    rtrim(number_format((float) $baggage->weight, 2, ',', ' '), '0'),
                                    ','
                                );

                                $typeMap = [
                                    'soute' => 'Soute',
                                    'checked' => 'Soute',
                                    'cabine' => 'Cabine',
                                    'supplementaire' => 'Soute',
                                    'special' => 'Soute',
                                ];

                                $typeText = $typeMap[strtolower((string) $baggage->type)]
                                    ?? ucfirst((string) $baggage->type);

                                $st = strtolower((string) $baggage->status);

                                [$locationText, $statusText, $statusClass] = match($st) {
                                    'loaded' => ['Avion', 'Chargé', 'loaded'],
                                    'delivered' => ['Passager', 'Livré', 'authorized'],
                                    'delayed', 'in_transit', 'checked_in' => ['Zone de livraison', 'Retardé', 'delayed'],
                                    'lost' => ['À localiser', 'Perdu', 'flagged'],
                                    'damaged' => ['Zone de traitement', 'Endommagé', 'flagged'],
                                    default => ['Zone de tri', 'Enregistré', 'registered'],
                                };
                            @endphp

                            <tr>
                                <td class="bag-ref">{{ $baggage->tag_number }}</td>
                                <td>{{ $passengerName }}</td>
                                <td>{{ $flightNumber }}</td>
                                <td>{{ $weightClean }} kg</td>
                                <td>{{ $typeText }}</td>
                                <td>{{ $locationText }}</td>
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td>
                                    <button
                                        type="button"
                                        class="action-dots-btn"
                                        title="Actions"
                                        onclick="toggleBagActions('bag-actions-{{ $baggage->id }}')"
                                    >
                                        •••
                                    </button>
                                </td>
                            </tr>

                            <!-- ACTIONS DU BAGAGE -->
                            <tr id="bag-actions-{{ $baggage->id }}" class="bag-action-row">
                                <td colspan="8">

                                    <div class="bag-action-box">

                                        <span>
                                            <strong>Réservation :</strong>
                                            {{ $baggage->reservation?->reference ?? 'N/A' }}
                                        </span>

                                        @if($baggage->incident_comment)
                                            <span class="incident-comment-display">
                                                <strong>Commentaire incident :</strong>
                                                {{ $baggage->incident_comment }}
                                            </span>
                                        @endif

                                        <a
                                            href="{{ route('admin.baggage.edit', $baggage) }}"
                                            class="mini-link"
                                        >
                                            Modifier
                                        </a>

                                        <form
                                            action="{{ route('admin.baggage.destroy', $baggage) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Supprimer ce bagage ?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="mini-delete-btn">
                                                Supprimer
                                            </button>
                                        </form>

                                    </div>

                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" style="text-align:center;padding:34px 14px;color:#718296;">
                                    Aucun bagage trouvé.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

            <!-- PAGINATION -->
            @if($baggages->hasPages())
                <div class="pagination-container">
                    {{ $baggages->links() }}
                </div>
            @endif

            <!-- FORMULAIRE DE SIGNALEMENT -->
            <div class="incident-box">

                <h3 class="card-title">Incident bagage</h3>

                <p class="card-subtitle">
                    Déclarer un bagage perdu, endommagé ou retardé.
                </p>

                <form
                    action="{{ route('admin.baggage.incidents.store') }}"
                    method="POST"
                    class="incident-grid"
                >
                    @csrf

                    <div class="field-group">
                        <label for="incident_ref">Référence du bagage</label>

                        <input
                            id="incident_ref"
                            type="text"
                            name="incident_ref"
                            class="field-input"
                            placeholder="BAG-________"
                            value="{{ old('incident_ref') }}"
                            required
                        >

                        @error('incident_ref')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="incident_type">Type d'incident</label>

                        <select
                            id="incident_type"
                            name="incident_type"
                            class="field-select"
                            required
                        >
                            <option value="">Sélectionner</option>

                            <option value="delayed" {{ old('incident_type') === 'delayed' ? 'selected' : '' }}>
                                Retardé
                            </option>

                            <option value="lost" {{ old('incident_type') === 'lost' ? 'selected' : '' }}>
                                Perdu
                            </option>

                            <option value="damaged" {{ old('incident_type') === 'damaged' ? 'selected' : '' }}>
                                Endommagé
                            </option>
                        </select>

                        @error('incident_type')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="incident_comment">Commentaire</label>

                        <input
                            id="incident_comment"
                            type="text"
                            name="incident_comment"
                            class="field-input"
                            placeholder="Ajouter une note"
                            value="{{ old('incident_comment') }}"
                        >

                        @error('incident_comment')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-blue">
                        Enregistrer
                    </button>

                </form>
            </div>

        </section>

    </main>
</div>

<script>
    function toggleBagActions(id) {
        const row = document.getElementById(id);

        if (row) {
            row.classList.toggle('open');
        }
    }
</script>

</body>
</html>