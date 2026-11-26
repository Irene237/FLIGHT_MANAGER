<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avions & Destinations | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-bg: #0c233c;
            --sidebar-active: #1d4ed8;
            --sidebar-hover: rgba(255, 255, 255, 0.06);
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #0f294a;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --blue: #1d5fd6;
            --green: #15803d;
            --green-bg: #dcfce7;
            --amber: #b45309;
            --amber-bg: #fef3c7;
            --red: #b91c1c;
            --red-bg: #fee2e2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button, input, select {
            font-family: inherit;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 224px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: white;
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
            gap: 11px;
            padding: 5px 8px 28px;
        }

        .brand-mark {
            width: 37px;
            height: 37px;
            border-radius: 11px;
            background: rgba(56, 189, 248, .13);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .brand-text strong {
            font-size: 15px;
            letter-spacing: 1.2px;
        }

        .brand-text span {
            font-size: 10px;
            letter-spacing: 2.7px;
            color: #9fb2c8;
            margin-top: 3px;
        }

        .nav-group-label {
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.3px;
            color: #8296ad;
            padding: 0 10px;
            margin: 12px 0 10px;
        }

        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 12px;
            border-radius: 8px;
            color: #c2cfdd;
            font-size: 12px;
            font-weight: 500;
            transition: .2s;
        }

        .nav-item > span:first-child {
            width: 19px;
            text-align: center;
            font-size: 16px;
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: white;
        }

        .nav-item.active {
            background: var(--sidebar-active);
            color: white;
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255,255,255,.1);
            padding-top: 16px;
        }

        .control-center-link {
            display: block;
            padding: 11px 12px;
            border-radius: 8px;
            background: rgba(255,255,255,.06);
            color: #dce7f3;
            font-size: 11px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .topbar-logout-form {
            display: inline-flex;
            margin: 0;
        }

        .logout-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #dc2626;
            font-size: 11.5px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        .logout-button:hover {
            background: #fee2e2;
        }

        /* MAIN */

        .main-wrapper {
            margin-left: 224px;
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            gap: 16px;
        }

        .breadcrumb {
            font-size: 12px;
            color: var(--text-muted);
        }

        .breadcrumb strong {
            color: var(--text-main);
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .admin-info strong {
            display: block;
            font-size: 11px;
            white-space: nowrap;
        }

        .admin-info span {
            font-size: 10px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .page-content {
            padding: 28px;
            max-width: 1600px;
            margin: auto;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 23px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 7px;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            background: var(--blue);
            color: white;
            border: 0;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .primary-button:hover {
            background: #1749a8;
        }

        /* NOTIFICATIONS */

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 12px;
        }

        .alert-success {
            background: var(--green-bg);
            color: var(--green);
        }

        .alert-error {
            background: var(--red-bg);
            color: var(--red);
        }

        /* STATISTICS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 23px;
        }

        .stat-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 11px;
            padding: 18px;
        }

        .stat-label {
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 500;
        }

        .stat-value {
            display: block;
            font-size: 25px;
            font-weight: 800;
            margin-top: 10px;
        }

        .stat-description {
            color: var(--text-muted);
            font-size: 10px;
            margin-top: 5px;
        }

        /* MAIN GRID */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 11px;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .card-header h2 {
            font-size: 13px;
            font-weight: 800;
        }

        .card-header p {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        .count-badge {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
        }

        .card-body {
            padding: 18px 20px;
        }

        /* SEARCH */

        .filter-form {
            display: flex;
            gap: 9px;
            margin-bottom: 17px;
        }

        .search-input,
        .filter-select {
            height: 38px;
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            padding: 0 11px;
            font-size: 11px;
            outline: none;
            background: white;
            color: var(--text-main);
        }

        .search-input {
            flex: 1;
            min-width: 0;
        }

        .filter-select {
            width: 125px;
        }

        .search-input:focus,
        .filter-select:focus {
            border-color: var(--blue);
        }

        .filter-button {
            border: 0;
            background: #eff6ff;
            color: #1d4ed8;
            border-radius: 7px;
            padding: 0 13px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        /* AIRCRAFT LIST */

        .aircraft-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .aircraft-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 13px;
            border: 1px solid var(--border-soft);
            border-radius: 9px;
            transition: .2s;
        }

        .aircraft-row:hover,
        .aircraft-row.selected {
            border-color: #93b4f5;
            background: #f5f8ff;
        }

        .aircraft-main {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .aircraft-icon {
            width: 39px;
            height: 39px;
            flex-shrink: 0;
            border-radius: 9px;
            background: #eff6ff;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }

        .aircraft-details {
            min-width: 0;
        }

        .aircraft-details strong {
            display: block;
            font-size: 11px;
            margin-bottom: 5px;
        }

        .aircraft-details span {
            color: var(--text-muted);
            font-size: 10px;
        }

        .aircraft-right {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .capacity {
            color: var(--text-muted);
            font-size: 10px;
            white-space: nowrap;
        }

        .status {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-available {
            color: var(--green);
            background: var(--green-bg);
        }

        .status-maintenance {
            color: var(--amber);
            background: var(--amber-bg);
        }

        .status-unavailable {
            color: var(--red);
            background: var(--red-bg);
        }

        .aircraft-actions {
            display: flex;
            gap: 6px;
            margin-top: 9px;
        }

        .small-link {
            font-size: 10px;
            color: var(--blue);
            font-weight: 700;
        }

        .small-link.danger {
            color: var(--red);
        }

        .pagination-area {
            margin-top: 17px;
        }

        /* SELECTED AIRCRAFT */

        .selected-aircraft {
            padding: 20px;
        }

        .plane-visual {
            height: 155px;
            border-radius: 10px;
            background: linear-gradient(135deg, #eaf2ff, #f5f8fc);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            overflow: hidden;
        }

        .plane-visual span {
            font-size: 75px;
            color: #1d5fd6;
            transform: rotate(-15deg);
        }

        .selected-title {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 17px;
        }

        .selected-title h3 {
            font-size: 17px;
            font-weight: 800;
        }

        .selected-title p {
            color: var(--text-muted);
            font-size: 11px;
            margin-top: 6px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .detail-item {
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #edf1f6;
            border-radius: 8px;
        }

        .detail-item span {
            display: block;
            font-size: 9px;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .detail-item strong {
            font-size: 11px;
        }

        .selected-actions {
            display: flex;
            gap: 9px;
            margin-top: 17px;
        }

        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 13px;
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            background: white;
            color: var(--text-main);
            font-size: 10px;
            font-weight: 700;
        }

        /* DESTINATIONS */

        .destinations-card {
            margin-top: 18px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 520px;
        }

        th {
            background: #f8fafc;
            color: var(--text-muted);
            text-align: left;
            padding: 12px 15px;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        td {
            padding: 13px 15px;
            border-bottom: 1px solid var(--border-soft);
            font-size: 10px;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .airport-code {
            display: inline-block;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 800;
            padding: 6px 8px;
            border-radius: 6px;
        }

        .airport-name strong {
            display: block;
            font-size: 10px;
        }

        .airport-name span {
            display: block;
            font-size: 9px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .empty-state {
            padding: 30px 15px;
            text-align: center;
            color: var(--text-muted);
            font-size: 11px;
        }

        /* RESPONSIVE */

        @media (max-width: 1100px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 65px;
                padding: 15px 8px;
            }

            .brand {
                justify-content: center;
                padding: 5px 0 25px;
            }

            .brand-text,
            .nav-group-label,
            .nav-item span:last-child,
            .control-center-link {
                display: none;
            }

            .nav-item {
                justify-content: center;
                padding: 12px 5px;
            }

            .main-wrapper {
                margin-left: 65px;
            }

            .page-content {
                padding: 18px 12px;
            }

            .topbar {
                padding: 0 12px;
                gap: 8px;
            }

            .topbar-right {
                gap: 8px;
            }

            .admin-info {
                display: none;
            }

            .logout-button {
                padding: 7px 9px;
                font-size: 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .stat-card {
                padding: 13px;
            }

            .stat-value {
                font-size: 20px;
            }

            .page-heading {
                flex-direction: column;
            }

            .filter-form {
                flex-wrap: wrap;
            }

            .search-input {
                flex-basis: 100%;
            }

            .filter-select {
                flex: 1;
            }
        }
    </style>
</head>

<body>

    {{-- BARRE LATÉRALE --}}
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

            <nav class="nav-list">

                <a href="{{ route('admin.dashboard') }}" class="nav-item">
                    <span>⌂</span>
                    <span>Vue d'ensemble</span>
                </a>

                <a href="{{ route('admin.flights.index') }}" class="nav-item">
                    <span>✈</span>
                    <span>Gestion des vols</span>
                </a>

                <a href="{{ route('admin.aircraft.index') }}" class="nav-item active">
                    <span>▣</span>
                    <span>Avions & destinations</span>
                </a>

                  <a href="{{ route('admin.reservations.index') }}" class="nav-item">
    <span >▣</span>
    <span>Réservations</span>
</a>
 <a href="{{ route('admin.users.index') }}" class="nav-item">
    <span>▣</span>
    <span>Utilisateurs</span>
</a>

                 <a href="{{ route('admin.baggage.index') }}" class="nav-item">
                    <span>▣</span>
                    <span>Bagages</span>
                </a>

             <a href="{{ route('admin.crew.index') }}" class="nav-item">
                    <span>♧</span>
                    <span>Équipages</span>
                </a>

                <a href="#" class="nav-item">
                    <span>⚙</span>
                    <span>Paramètres système</span>
                </a>

            </nav>
        </div>

        <div class="sidebar-footer">
            <div class="nav-group-label" style="padding-top:0;">
                ESPACE ADMINISTRATEUR
            </div>

            <a href="{{ route('admin.dashboard') }}" class="control-center-link">
                Centre de contrôle
            </a>
        </div>

    </aside>


    {{-- CONTENU PRINCIPAL --}}
    <main class="main-wrapper">

        {{-- BARRE SUPÉRIEURE --}}
        <header class="topbar">

            <div class="breadcrumb">
                Administration / <strong>Avions & destinations</strong>
            </div>

            <div class="topbar-right">
                <div class="admin-profile">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="admin-info">
                        <strong>{{ auth()->user()->name }}</strong>
                        <span>Administrateur</span>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="topbar-logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        ↪ Déconnexion
                    </button>
                </form>
            </div>

        </header>


        <div class="page-content">

            {{-- TITRE --}}
            <div class="page-heading">
                <div>
                    <h1>Avions & destinations</h1>
                    <p>Gérez votre parc aérien et les aéroports desservis par FLIGHT MANAGER.</p>
                </div>

                <a href="{{ route('admin.aircraft.create') }}" class="primary-button">
                    + Ajouter un avion
                </a>
            </div>


            {{-- MESSAGES --}}
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


            {{-- STATISTIQUES --}}
            <section class="stats-grid">

                <div class="stat-card">
                    <span class="stat-label">Total des avions</span>
                    <strong class="stat-value">{{ $totalAircraft }}</strong>
                    <p class="stat-description">Avions enregistrés dans la base</p>
                </div>

                <div class="stat-card">
                    <span class="stat-label">Avions disponibles</span>
                    <strong class="stat-value">{{ $availableAircraft }}</strong>
                    <p class="stat-description">Statut disponible</p>
                </div>

                <div class="stat-card">
                    <span class="stat-label">Avions indisponibles</span>
                    <strong class="stat-value">{{ $unavailableAircraft }}</strong>
                    <p class="stat-description">Maintenance ou indisponibilité</p>
                </div>

                <div class="stat-card">
                    <span class="stat-label">Capacité totale</span>
                    <strong class="stat-value">{{ number_format($totalCapacity, 0, ',', ' ') }}</strong>
                    <p class="stat-description">Places cumulées des avions</p>
                </div>

            </section>


            {{-- CONTENU AVIONS + FICHE --}}
            <section class="content-grid">

                {{-- PARC AÉRIEN --}}
                <div class="card">

                    <div class="card-header">
                        <div>
                            <h2>Parc aérien</h2>
                            <p>Liste des appareils enregistrés</p>
                        </div>

                        <span class="count-badge">
                            {{ $aircraft->total() }} appareil(s)
                        </span>
                    </div>

                    <div class="card-body">

                        {{-- RECHERCHE ET FILTRES --}}
                        <form action="{{ route('admin.aircraft.index') }}" method="GET" class="filter-form">

                            <input
                                type="text"
                                name="search"
                                class="search-input"
                                placeholder="Rechercher un avion..."
                                value="{{ request('search') }}"
                            >

                            <select name="status" class="filter-select">
                                <option value="">Tous les statuts</option>
                                <option value="available" @selected(request('status') === 'available')>
                                    Disponible
                                </option>
                                <option value="maintenance" @selected(request('status') === 'maintenance')>
                                    Maintenance
                                </option>
                                <option value="unavailable" @selected(request('status') === 'unavailable')>
                                    Indisponible
                                </option>
                            </select>

                            <button type="submit" class="filter-button">
                                Filtrer
                            </button>

                        </form>


                        {{-- LISTE DES AVIONS --}}
                        <div class="aircraft-list">

                            @forelse($aircraft as $plane)

                                <div class="aircraft-row {{ $selectedAircraft && $selectedAircraft->id === $plane->id ? 'selected' : '' }}">

                                    <a
                                        href="{{ route('admin.aircraft.index', array_merge(request()->except('page'), ['selected' => $plane->id])) }}"
                                        class="aircraft-main"
                                    >
                                        <div class="aircraft-icon">✈</div>

                                        <div class="aircraft-details">
                                            <strong>{{ $plane->model }}</strong>
                                            <span>{{ $plane->registration_number }} · {{ $plane->manufacturer }}</span>
                                        </div>
                                    </a>

                                    <div class="aircraft-right">

                                        <span class="capacity">
                                            {{ number_format($plane->capacity, 0, ',', ' ') }} places
                                        </span>

                                        @if($plane->status === 'available')
                                            <span class="status status-available">Disponible</span>
                                        @elseif($plane->status === 'maintenance')
                                            <span class="status status-maintenance">Maintenance</span>
                                        @else
                                            <span class="status status-unavailable">Indisponible</span>
                                        @endif

                                    </div>

                                </div>

                                <div class="aircraft-actions">
                                    <a href="{{ route('admin.aircraft.edit', $plane) }}" class="small-link">
                                        Modifier
                                    </a>

                                    <span style="color:#cbd5e1;">|</span>

                                    <form
                                        action="{{ route('admin.aircraft.destroy', $plane) }}"
                                        method="POST"
                                        onsubmit="return confirm('Voulez-vous vraiment supprimer cet avion ?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="small-link danger"
                                            style="border:0;background:none;cursor:pointer;"
                                        >
                                            Supprimer
                                        </button>
                                    </form>
                                </div>

                            @empty

                                <div class="empty-state">
                                    Aucun avion ne correspond à votre recherche.
                                </div>

                            @endforelse

                        </div>

                        <div class="pagination-area">
                            {{ $aircraft->links() }}
                        </div>

                    </div>
                </div>


                {{-- FICHE DE L'AVION SÉLECTIONNÉ --}}
                <div class="card">

                    <div class="card-header">
                        <div>
                            <h2>Fiche avion sélectionné</h2>
                            <p>Détails de l'appareil</p>
                        </div>
                    </div>

                    @if($selectedAircraft)

                        <div class="selected-aircraft">

                            <div class="plane-visual">
                                <span>✈</span>
                            </div>

                            <div class="selected-title">

                                <div>
                                    <h3>{{ $selectedAircraft->model }}</h3>
                                    <p>{{ $selectedAircraft->registration_number }}</p>
                                </div>

                                @if($selectedAircraft->status === 'available')
                                    <span class="status status-available">Disponible</span>
                                @elseif($selectedAircraft->status === 'maintenance')
                                    <span class="status status-maintenance">Maintenance</span>
                                @else
                                    <span class="status status-unavailable">Indisponible</span>
                                @endif

                            </div>

                            <div class="details-grid">

                                <div class="detail-item">
                                    <span>Constructeur</span>
                                    <strong>{{ $selectedAircraft->manufacturer }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Capacité maximale</span>
                                    <strong>{{ $selectedAircraft->capacity }} places</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Vols associés</span>
                                    <strong>{{ $selectedAircraft->flights->count() }}</strong>
                                </div>

                                <div class="detail-item">
                                    <span>Date d'enregistrement</span>
                                    <strong>
                                        {{ $selectedAircraft->created_at?->format('d/m/Y') ?? 'Non renseignée' }}
                                    </strong>
                                </div>

                            </div>

                            <div class="selected-actions">

                                <a
                                    href="{{ route('admin.aircraft.edit', $selectedAircraft) }}"
                                    class="primary-button"
                                >
                                    Modifier l'avion
                                </a>

                            </div>

                        </div>

                    @else

                        <div class="empty-state">
                            Aucun avion enregistré dans la base de données.
                        </div>

                    @endif

                </div>

            </section>


            {{-- DESTINATIONS --}}
            <section class="card destinations-card">

                <div class="card-header">
                    <div>
                        <h2>Destinations desservies</h2>
                        <p>Liste des aéroports enregistrés dans le système</p>
                    </div>

                    <span class="count-badge">
                        {{ $airports->count() }} destination(s)
                    </span>
                </div>

                <div class="table-wrapper">

                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Ville</th>
                                <th>Aéroport</th>
                                <th>Pays</th>
                                <th>Statut</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($airports as $airport)

                                <tr>
                                    <td>
                                        <span class="airport-code">
                                            {{ $airport->code }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>{{ $airport->city }}</strong>
                                    </td>

                                    <td class="airport-name">
                                        <strong>{{ $airport->name }}</strong>
                                        <span>{{ $airport->address ?: 'Adresse non renseignée' }}</span>
                                    </td>

                                    <td>{{ $airport->country }}</td>

                                    <td>
                                        @if($airport->is_active)
                                            <span class="status status-available">Actif</span>
                                        @else
                                            <span class="status status-unavailable">Inactif</span>
                                        @endif
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="empty-state">
                                        Aucun aéroport enregistré.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

            </section>

        </div>

    </main>

</body>
</html>