<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres système | FLIGHT MANAGER</title>

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
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --badge-blue-bg: #e0e7ff;
            --badge-blue-text: #1d4ed8;
            --gray-bg: #f1f5f9;
            --gray-text: #64748b;
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
            transition: background .18s, color .18s;
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
            border-radius: 50%;
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

        /* CONTENT */
        .content {
            padding: 20px 28px 38px;
        }

        .page-subtitle {
            font-size: 11.5px;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .alert {
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
            margin-bottom: 3px;
        }

        .card-subtitle {
            font-size: 10.5px;
            color: var(--text-muted);
        }

        /* GENERAL CONFIGURATION */
        .general-grid {
            display: grid;
            grid-template-columns: 1fr 1.15fr .75fr auto;
            gap: 14px;
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

        .field-input {
            width: 100%;
            height: 36px;
            border: 1px solid var(--input-border);
            border-radius: 7px;
            padding: 0 11px;
            background: white;
            color: var(--text-main);
            font-size: 11px;
            outline: none;
        }

        .field-input:focus {
            border-color: var(--blue);
        }

        .btn-blue {
            height: 36px;
            min-width: 110px;
            padding: 0 20px;
            border: none;
            border-radius: 7px;
            background: var(--blue);
            color: white;
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

        /* TWO COLUMNS */
        .settings-two-cols {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 18px;
        }

        .settings-two-cols .panel-card {
            margin-bottom: 0;
        }

        /* OPTIONS */
        .option-list {
            margin-top: 16px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .option-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .option-label strong {
            display: block;
            font-size: 11px;
            font-weight: 700;
        }

        .option-label span {
            display: block;
            font-size: 9.5px;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .option-simple-text {
            font-size: 11px;
            font-weight: 500;
            color: #334e68;
        }

        .pill-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 68px;
            height: 24px;
            padding: 0 12px;
            border-radius: 999px;
            border: none;
            font-size: 9.5px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity .15s;
        }

        .pill-toggle:hover {
            opacity: .85;
        }

        .pill-toggle.green {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .pill-toggle.blue {
            background: var(--badge-blue-bg);
            color: var(--badge-blue-text);
        }

        .pill-toggle.off {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .session-block {
            margin-top: 18px;
        }

        .session-block .field-input {
            max-width: 190px;
        }

        /* ROLES TABLE */
        .roles-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
            font-size: 11px;
        }

        .roles-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            color: var(--text-muted);
            text-transform: uppercase;
            background: #f8fafc;
            padding: 10px 12px;
        }

        .roles-table thead th:first-child {
            border-radius: 5px 0 0 5px;
        }

        .roles-table thead th:last-child {
            border-radius: 0 5px 5px 0;
        }

        .roles-table tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            vertical-align: middle;
        }

        .roles-table tbody tr:last-child td {
            border-bottom: none;
        }

        .role-name-cell {
            font-weight: 700;
            color: var(--text-main);
        }

        /* RESPONSIVE */
        @media (max-width: 1050px) {
            .general-grid {
                grid-template-columns: 1fr 1fr;
            }

            .btn-blue {
                grid-column: span 2;
                justify-self: end;
            }

            .settings-two-cols {
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

            .general-grid {
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
    $admin = auth()->user();
    $adminName = $admin->name ?? 'Admin';

    $initials = collect(explode(' ', $adminName))
        ->filter()
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('') ?: 'AD';

    $val = function (string $key, $default) use ($settings) {
        return old($key, $settings->get($key)?->value ?? $default);
    };

    $appName = $val('app_name', 'FLIGHT MANAGER');
    $contactEmail = $val('contact_email', 'support@flightmanager.cm');
    $currency = $val('currency', 'FCFA (XAF)');

    $mtnActive = (string) $val('payment_mtn', '1') === '1';
    $orangeActive = (string) $val('payment_orange', '1') === '1';
    $cardActive = (string) $val('payment_card', '1') === '1';

    $notifBooking = (string) $val('notify_booking_confirmation', '1') === '1';
    $notifReminder = (string) $val('notify_departure_reminder', '1') === '1';
    $notifDelay = (string) $val('notify_flight_delay', '1') === '1';

    $twoFactor = (string) $val('two_factor_auth', '1') === '1';

    // La durée est enregistrée sous forme numérique : 30, 60, 120...
    $sessionTimeout = (int) preg_replace(
        '/[^0-9]/',
        '',
        (string) $val('session_timeout', '30')
    );

    if ($sessionTimeout < 5) {
        $sessionTimeout = 30;
    }

    $loginLogs = (string) $val('login_logs', '1') === '1';
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

            <a href="{{ route('admin.baggage.index') }}" class="nav-item">
                <span>▣</span>
                <span>Bagages</span>
            </a>

            <a href="{{ route('admin.crew.index') }}" class="nav-item">
                <span>♧</span>
                <span>Équipages</span>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="nav-item active">
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

<!-- MAIN CONTENT -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">

        <div>
            <div class="breadcrumb">
                Administration / Paramètres système
            </div>

            <h1 class="topbar-title">
                Paramètres système
            </h1>
        </div>

        <div class="topbar-right">

            <button
                type="button"
                class="search-icon-btn"
                aria-label="Rechercher"
                onclick="document.getElementById('app_name').focus()"
            >
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

                <button type="submit" class="logout-btn">
                    ↪ Déconnexion
                </button>
            </form>

        </div>
    </header>

    <!-- PAGE CONTENT -->
    <main class="content">

        <p class="page-subtitle">
            Configurez les règles générales, les paiements, la sécurité et les accès.
        </p>

        @if(session('success'))
            <div class="alert alert-success">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Certains champs contiennent des erreurs :</strong>

                <ul style="margin:6px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- CONFIGURATION GENERALE -->
            <section class="panel-card">

                <h2 class="card-title">
                    Configuration générale
                </h2>

                <p class="card-subtitle">
                    Personnalisez les paramètres de fonctionnement de FLIGHT MANAGER.
                </p>

                <div class="general-grid">

                    <div class="field-group">
                        <label for="app_name">Nom de l'application</label>

                        <input
                            id="app_name"
                            type="text"
                            name="app_name"
                            class="field-input"
                            value="{{ $appName }}"
                            maxlength="100"
                            required
                        >
                    </div>

                    <div class="field-group">
                        <label for="contact_email">Adresse e-mail de contact</label>

                        <input
                            id="contact_email"
                            type="email"
                            name="contact_email"
                            class="field-input"
                            value="{{ $contactEmail }}"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="field-group">
                        <label for="currency">Devise</label>

                        <input
                            id="currency"
                            type="text"
                            name="currency"
                            class="field-input"
                            value="{{ $currency }}"
                            maxlength="30"
                            required
                        >
                    </div>

                    <button type="submit" class="btn-blue">
                        Enregistrer
                    </button>

                </div>
            </section>

            <!-- PAIEMENTS ET NOTIFICATIONS -->
            <div class="settings-two-cols">

                <!-- PAIEMENTS -->
                <section class="panel-card">

                    <h2 class="card-title">
                        Paiements et facturation
                    </h2>

                    <p class="card-subtitle">
                        Moyens de paiement proposés aux clients
                    </p>

                    <div class="option-list">

                        <div class="option-item">
                            <div class="option-label">
                                <strong>MTN Mobile Money</strong>
                                <span id="sub-payment_mtn">
                                    {{ $mtnActive ? 'Activé' : 'Désactivé' }}
                                </span>
                            </div>

                            <input
                                type="hidden"
                                name="payment_mtn"
                                id="input-payment_mtn"
                                value="{{ $mtnActive ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $mtnActive ? 'green' : 'off' }}"
                                onclick="togglePillSetting(this, 'payment_mtn', 'Activé', 'Désactivé', 'green')"
                            >
                                {{ $mtnActive ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                        <div class="option-item">
                            <div class="option-label">
                                <strong>Orange Money</strong>
                                <span id="sub-payment_orange">
                                    {{ $orangeActive ? 'Activé' : 'Désactivé' }}
                                </span>
                            </div>

                            <input
                                type="hidden"
                                name="payment_orange"
                                id="input-payment_orange"
                                value="{{ $orangeActive ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $orangeActive ? 'green' : 'off' }}"
                                onclick="togglePillSetting(this, 'payment_orange', 'Activé', 'Désactivé', 'green')"
                            >
                                {{ $orangeActive ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                        <div class="option-item">
                            <div class="option-label">
                                <strong>Carte bancaire</strong>
                                <span id="sub-payment_card">
                                    {{ $cardActive ? 'Activé' : 'Désactivé' }}
                                </span>
                            </div>

                            <input
                                type="hidden"
                                name="payment_card"
                                id="input-payment_card"
                                value="{{ $cardActive ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $cardActive ? 'green' : 'off' }}"
                                onclick="togglePillSetting(this, 'payment_card', 'Activé', 'Désactivé', 'green')"
                            >
                                {{ $cardActive ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                    </div>
                </section>

                <!-- NOTIFICATIONS -->
                <section class="panel-card">

                    <h2 class="card-title">
                        Notifications
                    </h2>

                    <p class="card-subtitle">
                        Messages envoyés aux clients et aux équipes
                    </p>

                    <div class="option-list">

                        <div class="option-item">
                            <span class="option-simple-text">
                                Confirmation de réservation
                            </span>

                            <input
                                type="hidden"
                                name="notify_booking_confirmation"
                                id="input-notify_booking_confirmation"
                                value="{{ $notifBooking ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $notifBooking ? 'blue' : 'off' }}"
                                onclick="togglePillSetting(this, 'notify_booking_confirmation', 'Activé', 'Désactivé', 'blue')"
                            >
                                {{ $notifBooking ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                        <div class="option-item">
                            <span class="option-simple-text">
                                Rappel avant le départ
                            </span>

                            <input
                                type="hidden"
                                name="notify_departure_reminder"
                                id="input-notify_departure_reminder"
                                value="{{ $notifReminder ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $notifReminder ? 'blue' : 'off' }}"
                                onclick="togglePillSetting(this, 'notify_departure_reminder', 'Activé', 'Désactivé', 'blue')"
                            >
                                {{ $notifReminder ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                        <div class="option-item">
                            <span class="option-simple-text">
                                Notification de retard
                            </span>

                            <input
                                type="hidden"
                                name="notify_flight_delay"
                                id="input-notify_flight_delay"
                                value="{{ $notifDelay ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $notifDelay ? 'blue' : 'off' }}"
                                onclick="togglePillSetting(this, 'notify_flight_delay', 'Activé', 'Désactivé', 'blue')"
                            >
                                {{ $notifDelay ? 'Activé' : 'Désactivé' }}
                            </button>
                        </div>

                    </div>
                </section>

            </div>

            <!-- SECURITE ET ROLES -->
            <div class="settings-two-cols">

                <!-- SECURITE -->
                <section class="panel-card">

                    <h2 class="card-title">
                        Sécurité et accès
                    </h2>

                    <p class="card-subtitle">
                        Contrôlez les accès à l'espace administrateur
                    </p>

                    <div class="option-list">

                        <div class="option-item">

                            <div class="option-label">
                                <strong>
                                    Authentification à deux facteurs
                                </strong>
                            </div>

                            <input
                                type="hidden"
                                name="two_factor_auth"
                                id="input-two_factor_auth"
                                value="{{ $twoFactor ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $twoFactor ? 'blue' : 'off' }}"
                                onclick="togglePillSetting(this, 'two_factor_auth', 'Recommandé', 'Désactivé', 'blue')"
                            >
                                {{ $twoFactor ? 'Recommandé' : 'Désactivé' }}
                            </button>

                        </div>

                    </div>

                    <div class="session-block field-group">

                        <label for="session_timeout">
                            Durée de session (minutes)
                        </label>

                        <input
                            id="session_timeout"
                            type="number"
                            name="session_timeout"
                            class="field-input"
                            value="{{ $sessionTimeout }}"
                            min="5"
                            max="1440"
                            required
                        >

                    </div>

                    <div class="option-list" style="margin-top:16px;">

                        <div class="option-item">

                            <div class="option-label">
                                <strong>Journal des connexions</strong>
                            </div>

                            <input
                                type="hidden"
                                name="login_logs"
                                id="input-login_logs"
                                value="{{ $loginLogs ? '1' : '0' }}"
                            >

                            <button
                                type="button"
                                class="pill-toggle {{ $loginLogs ? 'green' : 'off' }}"
                                onclick="togglePillSetting(this, 'login_logs', 'Activé', 'Désactivé', 'green')"
                            >
                                {{ $loginLogs ? 'Activé' : 'Désactivé' }}
                            </button>

                        </div>

                    </div>

                </section>

                <!-- ROLES ET PERMISSIONS -->
                <section class="panel-card">

                    <h2 class="card-title">
                        Rôles et permissions
                    </h2>

                    <p class="card-subtitle">
                        Définissez ce que chaque profil peut consulter ou modifier
                    </p>

                    <table class="roles-table">

                        <thead>
                            <tr>
                                <th>RÔLE</th>
                                <th>ACCÈS</th>
                                <th>PERMISSIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td class="role-name-cell">
                                    Super administrateur
                                </td>
                                <td>Complet</td>
                                <td>Toutes</td>
                            </tr>

                            <tr>
                                <td class="role-name-cell">
                                    Gestionnaire
                                </td>
                                <td>Opérations</td>
                                <td>Vols, avions, bagages</td>
                            </tr>

                            <tr>
                                <td class="role-name-cell">
                                    Agent
                                </td>
                                <td>Limité</td>
                                <td>Réservations, clients</td>
                            </tr>
                        </tbody>

                    </table>

                </section>

            </div>

        </form>

    </main>
</div>

<script>
    function togglePillSetting(button, key, onText, offText, activeColor) {

        const input = document.getElementById('input-' + key);
        const sub = document.getElementById('sub-' + key);

        if (!input || !button) {
            return;
        }

        const isCurrentlyOn = input.value === '1';

        if (isCurrentlyOn) {

            input.value = '0';

            button.textContent = offText;

            button.classList.remove('green', 'blue');
            button.classList.add('off');

            if (sub) {
                sub.textContent = offText;
            }

        } else {

            input.value = '1';

            button.textContent = onText;

            button.classList.remove('off');
            button.classList.add(activeColor);

            if (sub) {
                sub.textContent = onText;
            }

        }
    }
</script>

</body>
</html>