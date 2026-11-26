<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des vols | FLIGHT MANAGER</title>

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
            --surface: #ffffff;
            --text-main: #0f294a;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --blue: #1d5fd6;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --amber-bg: #fef3c7;
            --amber-text: #b45309;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
            --indigo-bg: #e0e7ff;
            --indigo-text: #3730a3;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
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
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            line-height: 1.05;
        }

        .brand-text strong {
            font-size: 15px;
            font-weight: 800;
            color: white;
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
            color: white;
        }

        .nav-item.active {
            background: var(--sidebar-active);
            color: white;
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

        /* CONTENU PRINCIPAL */

        .main-wrapper {
            margin-left: 224px;
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: white;
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
            color: var(--text-main);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 18px;
        }

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
            color: var(--text-main);
        }

        .admin-meta span {
            display: block;
            font-size: 9.5px;
            color: var(--text-muted);
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--red-bg);
            color: #dc2626;
            border: none;
            border-radius: 6px;
            padding: 7px 12px;
            font-size: 10.5px;
            font-weight: 700;
            cursor: pointer;
        }

        .content {
            padding: 24px 28px 36px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .page-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* BOUTONS */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 10px 15px;
            border: none;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .btn-primary {
            background: var(--blue);
            color: white;
        }

        .btn-primary:hover {
            background: #174bb0;
        }

        .btn-edit {
            background: #e8f0ff;
            color: #1d4ed8;
            padding: 7px 10px;
        }

        .btn-delete {
            background: var(--red-bg);
            color: var(--red-text);
            padding: 7px 10px;
        }

        /* NOTIFICATIONS */

        .flash {
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .flash-success {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .flash-error {
            background: var(--red-bg);
            color: var(--red-text);
        }

        /* STATISTIQUES */

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 20px;
        }

        .kpi-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 17px 19px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .kpi-label {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .kpi-value {
            font-size: 23px;
            font-weight: 800;
            color: var(--text-main);
        }

        .kpi-description {
            font-size: 9.5px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* FILTRES */

        .filter-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 17px 19px;
            margin-bottom: 18px;
        }

        .filter-title {
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 13px;
        }

        .filter-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .form-control {
            height: 38px;
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            padding: 0 12px;
            font-size: 10.5px;
            color: var(--text-main);
            background: #fff;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--blue);
        }

        .search-input {
            flex: 1;
            min-width: 200px;
        }

        .filter-select {
            min-width: 160px;
        }

        .btn-reset {
            background: #f1f5f9;
            color: #475569;
        }

        /* TABLEAU */

        .table-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .table-header {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid var(--border-soft);
        }

        .table-title {
            font-size: 13px;
            font-weight: 800;
        }

        .table-subtitle {
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .flight-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10.5px;
            min-width: 950px;
        }

        .flight-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            color: var(--text-muted);
            background: #f8fafc;
            padding: 12px 13px;
            white-space: nowrap;
        }

        .flight-table tbody td {
            padding: 14px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            white-space: nowrap;
        }

        .flight-table tbody tr:last-child td {
            border-bottom: none;
        }

        .flight-number {
            font-weight: 800;
            color: var(--text-main);
        }

        .route {
            font-weight: 700;
            color: var(--text-main);
        }

        .route small {
            display: block;
            font-size: 9px;
            color: var(--text-muted);
            font-weight: 400;
            margin-top: 3px;
        }

        .aircraft-info {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .aircraft-info strong {
            font-size: 10px;
            color: var(--text-main);
        }

        .aircraft-info span {
            font-size: 9px;
            color: var(--text-muted);
        }

        .price {
            font-weight: 700;
            color: var(--text-main);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 700;
        }

        .status-badge.scheduled {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .status-badge.in_progress {
            background: var(--indigo-bg);
            color: var(--indigo-text);
        }

        .status-badge.completed {
            background: #e2e8f0;
            color: #475569;
        }

        .status-badge.cancelled {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .actions form {
            display: inline;
        }

        .empty-state {
            text-align: center;
            padding: 35px 15px !important;
            color: var(--text-muted) !important;
        }

        /* PAGINATION */

        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid var(--border-soft);
        }

        .pagination-wrapper nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pagination-wrapper nav > div:first-child {
            font-size: 10px;
            color: var(--text-muted);
        }

        .pagination-wrapper nav > div:last-child {
            display: flex;
            gap: 5px;
        }

        .pagination-wrapper a,
        .pagination-wrapper span[aria-current="page"] span,
        .pagination-wrapper span[aria-disabled="true"] span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 30px;
            height: 30px;
            padding: 0 9px;
            border: 1px solid var(--border-soft);
            border-radius: 5px;
            font-size: 10px;
        }

        .pagination-wrapper span[aria-current="page"] span {
            background: var(--blue);
            color: white;
            border-color: var(--blue);
        }

        .pagination-wrapper span[aria-disabled="true"] span {
            color: #a0aec0;
        }

        /* RESPONSIVE */

        @media (max-width: 1120px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-wrapper {
                margin-left: 0;
            }

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

            .content {
                padding: 16px 18px 28px;
            }

            .page-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .filter-form {
                align-items: stretch;
                flex-direction: column;
            }

            .filter-form .form-control,
            .filter-form .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

@php
    $adminName = auth()->user()->name ?? 'Administrateur';

    $nameParts = preg_split('/\s+/', trim($adminName));

    $initials = strtoupper(
        substr($nameParts[0] ?? 'A', 0, 1) .
        (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : 'D')
    );

    $statusLabels = [
        'scheduled' => 'Programmé',
        'in_progress' => 'En cours',
        'completed' => 'Terminé',
        'cancelled' => 'Annulé',
    ];
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

        <nav class="nav-list">

            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <span>⌂</span>
                <span>Vue d'ensemble</span>
            </a>

            <a href="{{ route('admin.flights.index') }}" class="nav-item active">
                <span>✈</span>
                <span>Gestion des vols</span>
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="nav-item">
    <span>▣</span>
    <span>Avions &amp; destinations</span>
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

           <a href="{{ route('admin.settings.index') }}" class="nav-item">
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


<!-- CONTENU PRINCIPAL -->

<div class="main-wrapper">

    <!-- HEADER -->

    <header class="topbar">

        <div>
            <div class="breadcrumb">
                Administration / Gestion des vols
            </div>

            <h1 class="topbar-title">
                Gestion des vols
            </h1>
        </div>

        <div class="topbar-right">

            <div class="admin-badge">

                <span class="admin-avatar">
                    {{ $initials }}
                </span>

                <div class="admin-meta">
                    <strong>{{ $adminName }}</strong>
                    <span>Super administrateur</span>
                </div>

            </div>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button type="submit" class="logout-btn">
                    ↪ Déconnexion
                </button>
            </form>

        </div>

    </header>


    <main class="content">

        <!-- TITRE ET AJOUT -->

        <section class="page-heading">

            <div>
                <h2 style="font-size:17px;font-weight:800;">
                    Tous les vols
                </h2>

                <p class="page-subtitle">
                    Consultez, recherchez et gérez les vols de votre compagnie.
                </p>
            </div>

            <a href="{{ route('admin.flights.create') }}" class="btn btn-primary">
                <span>＋</span>
                Ajouter un vol
            </a>

        </section>


        <!-- MESSAGES DE CONFIRMATION -->

        @if(session('success'))
            <div class="flash flash-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash flash-error">
                ⚠ {{ session('error') }}
            </div>
        @endif


        <!-- STATISTIQUES -->

        <section class="kpi-grid">

            <div class="kpi-card">

                <div class="kpi-label">
                    Nombre total de vols
                </div>

                <div class="kpi-value">
                    {{ number_format($totalFlights, 0, ',', ' ') }}
                </div>

                <div class="kpi-description">
                    Tous les vols enregistrés dans la base de données
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-label">
                    Vols programmés à venir
                </div>

                <div class="kpi-value" style="color:#15803d;">
                    {{ number_format($scheduledFlights, 0, ',', ' ') }}
                </div>

                <div class="kpi-description">
                    Vols programmés dont le départ est à venir
                </div>

            </div>


            <div class="kpi-card">

                <div class="kpi-label">
                    Vols annulés
                </div>

                <div class="kpi-value" style="color:#dc2626;">
                    {{ number_format($cancelledFlights, 0, ',', ' ') }}
                </div>

                <div class="kpi-description">
                    Vols ayant le statut annulé
                </div>

            </div>

        </section>


        <!-- RECHERCHE ET FILTRES -->

        <section class="filter-card">

            <h3 class="filter-title">
                Recherche et filtres
            </h3>

            <form method="GET"
                  action="{{ route('admin.flights.index') }}"
                  class="filter-form">

                <input
                    type="text"
                    name="search"
                    class="form-control search-input"
                    placeholder="Rechercher un numéro de vol, une ville ou un aéroport..."
                    value="{{ request('search') }}"
                >

                <select name="status" class="form-control filter-select">

                    <option value="">
                        Tous les statuts
                    </option>

                    <option value="scheduled"
                        {{ request('status') === 'scheduled' ? 'selected' : '' }}>
                        Programmé
                    </option>

                    <option value="in_progress"
                        {{ request('status') === 'in_progress' ? 'selected' : '' }}>
                        En cours
                    </option>

                    <option value="completed"
                        {{ request('status') === 'completed' ? 'selected' : '' }}>
                        Terminé
                    </option>

                    <option value="cancelled"
                        {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                        Annulé
                    </option>

                </select>

                <button type="submit" class="btn btn-primary">
                    🔍 Rechercher
                </button>

                <a href="{{ route('admin.flights.index') }}" class="btn btn-reset">
                    Réinitialiser
                </a>

            </form>

        </section>


        <!-- TABLEAU DES VOLS -->

        <section class="table-card">

            <div class="table-header">

                <div>
                    <h3 class="table-title">
                        Liste des vols
                    </h3>

                    <p class="table-subtitle">
                        {{ $flights->total() }}
                        vol(s) correspondant à votre recherche.
                    </p>
                </div>

            </div>


            <div class="table-responsive">

                <table class="flight-table">

                    <thead>
                        <tr>
                            <th>NUMÉRO</th>
                            <th>TRAJET</th>
                            <th>DÉPART</th>
                            <th>ARRIVÉE</th>
                            <th>AVION</th>
                            <th>PLACES</th>
                            <th>PRIX</th>
                            <th>STATUT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($flights as $flight)

                            <tr>

                                <!-- NUMÉRO DU VOL -->

                                <td>
                                    <span class="flight-number">
                                        {{ $flight->flight_number }}
                                    </span>
                                </td>


                                <!-- TRAJET -->

                                <td>
                                    <div class="route">

                                        {{ $flight->departureAirport?->code ?? 'N/A' }}
                                        →
                                        {{ $flight->arrivalAirport?->code ?? 'N/A' }}

                                        <small>
                                            {{ $flight->departureAirport?->city ?? 'Inconnu' }}
                                            →
                                            {{ $flight->arrivalAirport?->city ?? 'Inconnu' }}
                                        </small>

                                    </div>
                                </td>


                                <!-- DATE DE DÉPART -->

                                <td>
                                    {{ $flight->departure_at?->format('d/m/Y H:i') ?? 'Non définie' }}
                                </td>


                                <!-- DATE D'ARRIVÉE -->

                                <td>
                                    {{ $flight->arrival_at?->format('d/m/Y H:i') ?? 'Non définie' }}
                                </td>


                                <!-- AVION -->

                                <td>

                                    @if($flight->aircraft)

                                        <div class="aircraft-info">
                                            <strong>
                                                {{ $flight->aircraft->registration_number }}
                                            </strong>

                                            <span>
                                                {{ $flight->aircraft->model }}
                                            </span>
                                        </div>

                                    @else

                                        <span style="color:#94a3b8;">
                                            Non affecté
                                        </span>

                                    @endif

                                </td>


                                <!-- PLACES -->

                                <td>
                                    {{ $flight->available_seats }}
                                </td>


                                <!-- PRIX -->

                                <td>
                                    <span class="price">
                                        {{ number_format((float) $flight->price, 0, ',', ' ') }}
                                        FCFA
                                    </span>
                                </td>


                                <!-- STATUT -->

                                <td>

                                    <span class="status-badge {{ $flight->status }}">
                                        {{ $statusLabels[$flight->status] ?? ucfirst($flight->status) }}
                                    </span>

                                </td>


                                <!-- ACTIONS -->

                                <td>

                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.flights.edit', $flight->id) }}"
                                            class="btn btn-edit"
                                            title="Modifier ce vol"
                                        >
                                            ✎ Modifier
                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('admin.flights.destroy', $flight->id) }}"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer le vol {{ $flight->flight_number }} ?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-delete"
                                                title="Supprimer ce vol"
                                            >
                                                ✕
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="empty-state">

                                    <div style="font-size:28px;margin-bottom:10px;">
                                        ✈
                                    </div>

                                    <strong>
                                        Aucun vol trouvé
                                    </strong>

                                    <p style="margin-top:6px;">
                                        Aucun vol ne correspond aux critères de recherche.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            <!-- PAGINATION -->

            @if($flights->hasPages())

                <div class="pagination-wrapper">
                    {{ $flights->links() }}
                </div>

            @endif

        </section>

    </main>

</div>

</body>
</html>