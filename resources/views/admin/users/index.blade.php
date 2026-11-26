<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs | FLIGHT MANAGER</title>

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
            --input-border: #dce4ee;
            --blue: #1d5fd6;
            --blue-hover: #1749a8;
            --logout-bg: #fee2e2;
            --logout-text: #dc2626;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 224px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: #ffffff;
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
            border-radius: 999px;
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
            letter-spacing: 0.3px;
            color: #ffffff;
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
            letter-spacing: 0.8px;
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
            transition: background 0.18s, color 0.18s;
        }

        .nav-item:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .nav-item.active {
            background: var(--sidebar-active);
            color: #ffffff;
            font-weight: 600;
        }

        .sidebar-footer {
            padding-top: 16px;
            margin-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
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

        /* ===== MAIN AREA ===== */
        .main-wrapper {
            margin-left: 224px;
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        /* ===== TOPBAR ===== */
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
            letter-spacing: -0.3px;
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
            align-items: center;
            justify-content: center;
            padding: 6px;
            border-radius: 6px;
        }

        .search-icon-btn:hover {
            background: #f1f5f9;
        }

        .admin-badge {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .admin-avatar {
            width: 30px;
            height: 30px;
            border-radius: 999px;
            background: #e6f0fa;
            color: var(--blue);
            font-size: 10.5px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .admin-meta strong {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-main);
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

        .logout-btn:hover {
            background: #fecaca;
        }

        /* ===== CONTENT ===== */
        .content {
            padding: 20px 28px 38px;
        }

        .page-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #15803d;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 16px;
            font-size: 12px;
        }

        /* ===== DIRECTORY FILTER CARD ===== */
        .panel-card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 20px 22px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(15, 41, 74, 0.02);
        }

        .panel-top-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 14px;
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

        .filter-grid {
            display: grid;
            grid-template-columns: 1.35fr 0.9fr 0.9fr auto;
            gap: 12px;
            align-items: end;
            margin-top: 12px;
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
            background: #ffffff;
            color: var(--text-main);
            font-size: 11px;
            outline: none;
        }

        .field-input::placeholder {
            color: #94a3b8;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--blue);
        }

        .btn-blue {
            height: 36px;
            padding: 0 20px;
            border: none;
            border-radius: 7px;
            background: var(--blue);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
        }

        .btn-blue:hover {
            background: var(--blue-hover);
        }

        /* ===== USERS TABLE ===== */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 780px;
            font-size: 11px;
        }

        .users-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 0.4px;
            color: var(--text-muted);
            text-transform: uppercase;
            background: #f8fafc;
            padding: 10px 12px;
        }

        .users-table thead th:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .users-table thead th:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .users-table tbody td {
            padding: 13px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            vertical-align: middle;
            white-space: nowrap;
        }

        .users-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-name-cell {
            font-weight: 700;
            color: var(--text-main);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 66px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 700;
        }

        .status-badge.active {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .status-badge.suspended {
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

        .user-detail-row {
            display: none;
            background: #f8fafc;
        }

        .user-detail-row.open {
            display: table-row;
        }

        .user-detail-box {
            padding: 9px 14px;
            font-size: 11px;
            color: #486581;
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
        }

        /* ===== PANEL FOOTER & PAGINATION ===== */
        .panel-footer-note {
            margin-top: 22px;
            font-size: 10.5px;
            color: var(--text-muted);
        }

        .pagination-container {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 960px) {
            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .btn-blue {
                grid-column: span 2;
                justify-self: end;
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

            .panel-top-row {
                flex-direction: column;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .btn-blue {
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

    $searchValue = request('search', request('query_name'));
    $statusFilter = request('status');
    $periodFilter = request('period');
@endphp

<!-- SIDEBAR -->
<aside class="sidebar">
    <div>
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true">
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
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 10.5 12 3l9 7.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1v-9.5z"/>
                </svg>
                <span>Vue d'ensemble</span>
            </a>

            <a href="{{ route('admin.flights.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                </svg>
                <span>Gestion des vols</span>
            </a>

            <a href="{{ route('admin.aircraft.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                    <circle cx="12" cy="12" r="2.5"/>
                </svg>
                <span>Avions &amp; destinations</span>
            </a>

            <a href="{{ route('admin.reservations.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="4" y="3" width="16" height="18" rx="2"/>
                    <line x1="8" y1="8" x2="16" y2="8"/>
                    <line x1="8" y1="12" x2="16" y2="12"/>
                    <line x1="8" y1="16" x2="13" y2="16"/>
                </svg>
                <span>Réservations</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-item active">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Utilisateurs</span>
            </a>

             <a href="{{ route('admin.baggage.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="7" width="14" height="13" rx="2"/>
                    <path d="M9 7V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
                <span>Bagages</span>
            </a>

            <a href="{{ route('admin.crew.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-3.3 3.6-6 8-6s8 2.7 8 6"/>
                </svg>
                <span>Équipages</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="nav-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                </svg>
                <span>Paramètres système</span>
            </a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="nav-group-label" style="padding-top: 0;">ESPACE ADMINISTRATEUR</div>
        <a href="{{ route('admin.dashboard') }}" class="control-center-link">Centre de contrôle</a>
    </div>
</aside>

<!-- MAIN CONTENT -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">
        <div>
            <div class="breadcrumb">Administration / Gestion des utilisateurs</div>
            <h1 class="topbar-title">Gestion des utilisateurs</h1>
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
        <p class="page-subtitle">Administrez les comptes clients et leurs droits d'accès.</p>

        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <!-- CARTE 1 : ANNUAIRE DES CLIENTS -->
        <section class="panel-card">
            <h2 class="card-title">Annuaire des clients</h2>
            <p class="card-subtitle">Gérez les comptes, consultez les profils et contrôlez les accès.</p>

            <form action="{{ route('admin.users.index') }}" method="GET" class="filter-grid">
                <div class="field-group">
                    <label for="search">Rechercher un client</label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        class="field-input"
                        placeholder="Nom, e-mail ou téléphone"
                        value="{{ $searchValue }}"
                    >
                </div>

                <div class="field-group">
                    <label for="status">Statut du compte</label>
                    <select id="status" name="status" class="field-select">
                        <option value="" {{ empty($statusFilter) ? 'selected' : '' }}>Tous</option>
                        <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="suspended" {{ $statusFilter === 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="period">Inscription</label>
                    <select id="period" name="period" class="field-select">
                        <option value="" {{ empty($periodFilter) ? 'selected' : '' }}>Toutes les dates</option>
                        <option value="7d" {{ $periodFilter === '7d' ? 'selected' : '' }}>7 derniers jours</option>
                        <option value="30d" {{ $periodFilter === '30d' ? 'selected' : '' }}>30 derniers jours</option>
                    </select>
                </div>

                <button type="submit" class="btn-blue">Rechercher</button>
            </form>
        </section>

        <!-- CARTE 2 : LISTE DES UTILISATEURS -->
        <section class="panel-card">
            <div class="panel-top-row">
                <div>
                    <h2 class="card-title">Liste des utilisateurs</h2>
                    <p class="card-subtitle">Les administrateurs peuvent consulter, activer ou suspendre les comptes clients.</p>
                </div>

                <<a href="{{ route('admin.users.create') }}" class="btn-blue">
    + Ajouter client
</a>
            </div>

            <div class="table-responsive">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>CLIENT</th>
                            <th>E-MAIL</th>
                            <th>TÉLÉPHONE</th>
                            <th>INSCRIPTION</th>
                            <th>RÉSERVATIONS</th>
                            <th>STATUT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($users as $user)
                            @php
                                $isSuspended = strtolower((string) ($user->status ?? '')) === 'suspended'
                                    || (isset($user->is_active) && !$user->is_active);
                            @endphp

                            <tr>
                                <td class="user-name-cell">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?: 'Non renseigné' }}</td>
                                <td>{{ $user->created_at ? $user->created_at->format('d/m/Y') : '—' }}</td>
                                <td>{{ $user->reservations_count ?? 0 }}</td>
                                <td>
                                    @if($isSuspended)
                                        <span class="status-badge suspended">Suspendu</span>
                                    @else
                                        <span class="status-badge active">Actif</span>
                                    @endif
                                </td>
                                <td>
                                    <button
                                        type="button"
                                        class="action-dots-btn"
                                        title="Voir les détails"
                                        onclick="toggleUserDetail('user-detail-{{ $user->id }}')"
                                    >
                                        •••
                                    </button>
                                </td>
                            </tr>

                            <tr id="user-detail-{{ $user->id }}" class="user-detail-row">
                                <td colspan="7">
                                    <div class="user-detail-box">
                                        <span><strong>Rôle :</strong> {{ $user->role === 'admin' ? 'Administrateur' : 'Client' }}</span>
                                        <span><strong>ID :</strong> #{{ $user->id }}</span>
                                        <span><strong>Réservations :</strong> {{ $user->reservations_count ?? 0 }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; padding: 34px 14px; color: #718296;">
                                    Aucun utilisateur trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p class="panel-footer-note">
                Conseil : vérifiez l'identité avant toute modification sensible du compte.
            </p>

            @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="pagination-container">
                    {{ $users->links() }}
                </div>
            @endif
        </section>
    </main>

</div>

<script>
    function toggleUserDetail(id) {
        const row = document.getElementById(id);
        if (row) {
            row.classList.toggle('open');
        }
    }

    function focusUserSearch() {
        const input = document.getElementById('search');
        if (input) {
            input.focus();
            input.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>

</body>
</html>