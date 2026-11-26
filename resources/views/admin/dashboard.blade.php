<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | FLIGHT MANAGER</title>

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
            --sidebar-hover: rgba(255, 255, 255, 0.06);
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #0f294a;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --blue-bar: #1d5fd6;
            --blue-bar-track: #e6eefc;
            --logout-bg: #fee2e2;
            --logout-text: #dc2626;
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

        button {
            font-family: inherit;
        }

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
            color: var(--blue-bar);
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
            background: var(--logout-bg);
            color: var(--logout-text);
            border: none;
            border-radius: 6px;
            padding: 7px 12px;
            font-size: 10.5px;
            font-weight: 700;
            cursor: pointer;
        }

        .content {
            padding: 20px 28px 36px;
        }

        .page-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 18px;
        }

        .kpi-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 16px 18px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .kpi-label {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .kpi-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .kpi-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
        }

        .kpi-pill {
            font-size: 9.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 999px;
            background: var(--green-bg);
            color: var(--green-text);
            white-space: nowrap;
        }

        .analytics-grid {
            display: grid;
            grid-template-columns: 1.05fr 1.15fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        .panel-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 20px 22px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .panel-title {
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 3px;
        }

        .panel-subtitle {
            font-size: 10.5px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .chart-bars {
            height: 170px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
            padding: 10px 8px 0;
        }

        .bar-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }

        .bar-track {
            width: 18px;
            flex: 1;
            background: var(--blue-bar-track);
            border-radius: 5px;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }

        .bar-fill {
            width: 100%;
            background: var(--blue-bar);
            border-radius: 5px;
            min-height: 0;
            transition: height .3s ease;
        }

        .bar-day {
            font-size: 9.5px;
            color: var(--text-muted);
            margin-top: 8px;
        }

        .bar-count {
            font-size: 9px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .res-table-wrap {
            overflow-x: auto;
        }

        .res-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .res-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            color: var(--text-muted);
            background: #f8fafc;
            padding: 8px 10px;
        }

        .res-table tbody td {
            padding: 11px 10px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            white-space: nowrap;
        }

        .res-table tbody tr:last-child td {
            border-bottom: none;
        }

        .res-ref {
            font-weight: 700;
            color: var(--text-main);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 9px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 700;
        }

        .status-badge.confirmed {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .status-badge.pending {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .status-badge.cancelled {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .alerts-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .alert-row {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 11.5px;
            color: #334e68;
        }

        .alert-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 74px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 700;
        }

        .alert-tag.maintenance {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .alert-tag.baggage {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .alert-tag.crew {
            background: var(--indigo-bg);
            color: var(--indigo-text);
        }

        .empty-state {
            text-align: center;
            padding: 22px 10px;
            color: var(--text-muted);
            font-size: 11px;
        }

        @media (max-width: 1120px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .analytics-grid {
                grid-template-columns: 1fr;
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

            .kpi-grid {
                grid-template-columns: 1fr;
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
        'confirmed' => 'Confirmée',
        'pending' => 'En attente',
        'cancelled' => 'Annulée',
    ];
@endphp

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

    <a href="{{ route('admin.dashboard') }}" class="nav-item active">
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
    <span class="menu-icon">▣</span>
    <span>Réservations</span>
</a>

 <a href="{{ route('admin.users.index') }}" class="nav-item">
    <span class="menu-icon">▣</span>
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
        <div class="nav-group-label" style="padding-top:0;">ESPACE ADMINISTRATEUR</div>
        <a href="{{ route('admin.dashboard') }}" class="control-center-link">
            Centre de contrôle
        </a>
    </div>
</aside>

<div class="main-wrapper">

    <header class="topbar">
        <div>
            <div class="breadcrumb">Administration / Tableau de bord</div>
            <h1 class="topbar-title">Tableau de bord</h1>
        </div>

        <div class="topbar-right">
            <div class="admin-badge">
                <span class="admin-avatar">{{ $initials }}</span>

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

        <p class="page-subtitle">
            Vue générale de l'activité et des indicateurs clés de votre compagnie.
        </p>

        <!-- STATISTIQUES RÉELLES -->
        <section class="kpi-grid">

            <div class="kpi-card">
                <div class="kpi-label">Vols programmés</div>
                <div class="kpi-bottom">
                    <div class="kpi-value">
                        {{ number_format($totalFlights, 0, ',', ' ') }}
                    </div>
                    <span class="kpi-pill">Données réelles</span>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-label">Réservations</div>
                <div class="kpi-bottom">
                    <div class="kpi-value">
                        {{ number_format($totalReservations, 0, ',', ' ') }}
                    </div>
                    <span class="kpi-pill">Données réelles</span>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-label">Passagers</div>
                <div class="kpi-bottom">
                    <div class="kpi-value">
                        {{ number_format($totalPassengers, 0, ',', ' ') }}
                    </div>
                    <span class="kpi-pill">Données réelles</span>
                </div>
            </div>

            <div class="kpi-card">
                <div class="kpi-label">Revenus générés</div>
                <div class="kpi-bottom">
                    <div class="kpi-value">
                        {{ number_format($totalRevenue, 0, ',', ' ') }} FCFA
                    </div>
                    <span class="kpi-pill">Paiements réussis</span>
                </div>
            </div>

        </section>

        <!-- DIAGRAMME ET DERNIÈRES RÉSERVATIONS -->
        <section class="analytics-grid">

            <div class="panel-card">
                <h2 class="panel-title">Activité des réservations</h2>
                <p class="panel-subtitle">
                    Nombre réel de réservations sur les 7 derniers jours
                </p>

                <div class="chart-bars">

                    @foreach($activityDays as $item)
                        <div class="bar-col">

                            <span class="bar-count">
                                {{ $item['count'] }}
                            </span>

                            <div class="bar-track"
                                 title="{{ $item['date'] }} : {{ $item['count'] }} réservation(s)">

                                <div class="bar-fill"
                                     style="height: {{ $item['pct'] }}%;">
                                </div>

                            </div>

                            <span class="bar-day">
                                {{ $item['day'] }}
                            </span>

                        </div>
                    @endforeach

                </div>
            </div>

            <div class="panel-card">
                <h2 class="panel-title">Dernières réservations</h2>
                <p class="panel-subtitle">
                    Suivi des réservations enregistrées dans la base
                </p>

                <div class="res-table-wrap">
                    <table class="res-table">

                        <thead>
                            <tr>
                                <th>RÉFÉRENCE</th>
                                <th>CLIENT</th>
                                <th>VOL</th>
                                <th>STATUT</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentReservations as $reservation)
                                <tr>
                                    <td class="res-ref">
                                        {{ $reservation->reference }}
                                    </td>

                                    <td>
                                        {{ $reservation->client_name }}
                                    </td>

                                    <td>
                                        {{ $reservation->departure_code }}
                                        →
                                        {{ $reservation->arrival_code }}
                                    </td>

                                    <td>
                                        <span class="status-badge
                                            {{ $reservation->status === 'confirmed' ? 'confirmed' : ($reservation->status === 'pending' ? 'pending' : 'cancelled') }}">
                                            {{ $statusLabels[$reservation->status] ?? ucfirst($reservation->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="empty-state">
                                        Aucune réservation enregistrée pour le moment.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>
            </div>

        </section>

        <!-- ALERTES RÉELLES -->
        <section class="panel-card">

            <h2 class="panel-title">
                Alertes et opérations à surveiller
            </h2>

            <p class="panel-subtitle">
                État actuel des avions et des bagages enregistrés
            </p>

            <div class="alerts-list">

                <div class="alert-row">
                    <span class="alert-tag maintenance">Maintenance</span>

                    <span>
                        {{ $unavailableAircraft }}
                        avion(s) avec un statut différent de disponible.
                    </span>
                </div>

                <div class="alert-row">
                    <span class="alert-tag baggage">Bagages</span>

                    <span>
                        {{ $baggageIssues }}
                        bagage(s) avec un statut différent de enregistré.
                    </span>
                </div>

                <div class="alert-row">
                    <span class="alert-tag crew">Équipages</span>

                    <span>
                        Gestion des affectations non encore configurée.
                    </span>
                </div>

            </div>

        </section>

    </main>

</div>

</body>
</html>