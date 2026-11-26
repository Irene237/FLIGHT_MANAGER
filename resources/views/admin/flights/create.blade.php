<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajouter un vol | FLIGHT MANAGER</title>

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

        .page-heading h2 {
            font-size: 17px;
            font-weight: 800;
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

        .btn-reset {
            background: #f1f5f9;
            color: #475569;
        }

        /* FORMULAIRE */

        .form-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
        }

        .form-section {
            margin-bottom: 27px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-soft);
        }

        .section-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #e8f0ff;
            color: var(--blue);
            font-size: 16px;
        }

        .section-heading h3 {
            font-size: 12px;
            font-weight: 800;
        }

        .section-heading p {
            font-size: 9.5px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 19px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 10.5px;
            font-weight: 700;
            color: #334e68;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            height: 40px;
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            padding: 0 12px;
            font-size: 10.5px;
            color: var(--text-main);
            background: white;
            outline: none;
            transition: .2s;
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(29,95,214,.08);
        }

        .form-help {
            font-size: 9px;
            color: var(--text-muted);
        }

        .field-error {
            font-size: 10px;
            color: #dc2626;
        }

        /* ALERTES */

        .flash {
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .flash-error {
            background: var(--red-bg);
            color: var(--red-text);
        }

        /* ACTIONS */

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid var(--border-soft);
        }

        /* RESPONSIVE */

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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
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

            <a href="#" class="nav-item">
                <span>▣</span>
                <span>Avions &amp; destinations</span>
            </a>

            <a href="#" class="nav-item">
                <span>▤</span>
                <span>Réservations</span>
            </a>

            <a href="#" class="nav-item">
                <span>♙</span>
                <span>Utilisateurs</span>
            </a>

            <a href="#" class="nav-item">
                <span>▣</span>
                <span>Bagages</span>
            </a>

            <a href="#" class="nav-item">
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


<!-- CONTENU PRINCIPAL -->

<div class="main-wrapper">

    <header class="topbar">

        <div>
            <div class="breadcrumb">
                Administration / Gestion des vols / Ajouter
            </div>

            <h1 class="topbar-title">
                Ajouter un vol
            </h1>
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

        <!-- TITRE DE LA PAGE -->

        <section class="page-heading">

            <div>
                <h2>Programmer un nouveau vol</h2>

                <p class="page-subtitle">
                    Renseignez les informations du vol pour l'enregistrer dans le système.
                </p>
            </div>

            <a href="{{ route('admin.flights.index') }}" class="btn btn-reset">
                ← Retour à la liste
            </a>

        </section>


        <!-- ERREURS DE VALIDATION -->

        @if ($errors->any())

            <div class="flash flash-error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>

                <ul style="margin:8px 0 0 18px;">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>

        @endif


        <!-- FORMULAIRE -->

        <form method="POST" action="{{ route('admin.flights.store') }}">

            @csrf

            <section class="form-card">

                <!-- SECTION 1 : IDENTIFICATION -->

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">✈</div>

                        <div>
                            <h3>Identification du vol</h3>
                            <p>Numéro et affectation de l'avion.</p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="flight_number">
                                Numéro du vol <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                id="flight_number"
                                name="flight_number"
                                class="form-control"
                                value="{{ old('flight_number') }}"
                                placeholder="Exemple : FM004"
                                required
                            >

                            @error('flight_number')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="aircraft_id">
                                Avion affecté
                            </label>

                            <select
                                name="aircraft_id"
                                id="aircraft_id"
                                class="form-control"
                            >

                                <option value="">
                                    Aucun avion affecté
                                </option>

                                @foreach ($aircraft as $plane)

                                    <option
                                        value="{{ $plane->id }}"
                                        {{ old('aircraft_id') == $plane->id ? 'selected' : '' }}
                                    >
                                        {{ $plane->registration_number }}
                                        — {{ $plane->model }}
                                        ({{ $plane->capacity }} places)
                                    </option>

                                @endforeach

                            </select>

                            @error('aircraft_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                            <span class="form-help">
                                Seuls les avions disponibles sont proposés.
                            </span>

                        </div>

                    </div>

                </div>


                <!-- SECTION 2 : ITINERAIRE -->

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">⌖</div>

                        <div>
                            <h3>Itinéraire du vol</h3>
                            <p>Définissez les aéroports de départ et d'arrivée.</p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="departure_airport_id">
                                Aéroport de départ <span class="required">*</span>
                            </label>

                            <select
                                name="departure_airport_id"
                                id="departure_airport_id"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    Choisir l'aéroport de départ
                                </option>

                                @foreach ($airports as $airport)

                                    <option
                                        value="{{ $airport->id }}"
                                        {{ old('departure_airport_id') == $airport->id ? 'selected' : '' }}
                                    >
                                        {{ $airport->code }} — {{ $airport->city }},
                                        {{ $airport->country }}
                                    </option>

                                @endforeach

                            </select>

                            @error('departure_airport_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="arrival_airport_id">
                                Aéroport d'arrivée <span class="required">*</span>
                            </label>

                            <select
                                name="arrival_airport_id"
                                id="arrival_airport_id"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    Choisir l'aéroport d'arrivée
                                </option>

                                @foreach ($airports as $airport)

                                    <option
                                        value="{{ $airport->id }}"
                                        {{ old('arrival_airport_id') == $airport->id ? 'selected' : '' }}
                                    >
                                        {{ $airport->code }} — {{ $airport->city }},
                                        {{ $airport->country }}
                                    </option>

                                @endforeach

                            </select>

                            @error('arrival_airport_id')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                </div>


                <!-- SECTION 3 : HORAIRES -->

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">◷</div>

                        <div>
                            <h3>Dates et horaires</h3>
                            <p>Précisez les horaires prévus du voyage.</p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="departure_at">
                                Date et heure de départ <span class="required">*</span>
                            </label>

                            <input
                                type="datetime-local"
                                id="departure_at"
                                name="departure_at"
                                class="form-control"
                                value="{{ old('departure_at') }}"
                                required
                            >

                            @error('departure_at')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="arrival_at">
                                Date et heure d'arrivée <span class="required">*</span>
                            </label>

                            <input
                                type="datetime-local"
                                id="arrival_at"
                                name="arrival_at"
                                class="form-control"
                                value="{{ old('arrival_at') }}"
                                required
                            >

                            @error('arrival_at')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                </div>


                <!-- SECTION 4 : TARIFICATION -->

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">₣</div>

                        <div>
                            <h3>Tarification et capacité</h3>
                            <p>Définissez le prix du billet et les places disponibles.</p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="price">
                                Prix du billet (FCFA) <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="price"
                                name="price"
                                class="form-control"
                                value="{{ old('price') }}"
                                min="0"
                                step="1"
                                placeholder="Exemple : 250000"
                                required
                            >

                            @error('price')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label for="available_seats">
                                Nombre de places disponibles <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                id="available_seats"
                                name="available_seats"
                                class="form-control"
                                value="{{ old('available_seats') }}"
                                min="1"
                                placeholder="Exemple : 180"
                                required
                            >

                            @error('available_seats')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                            <span class="form-help">
                                Le nombre de places ne doit pas dépasser la capacité de l'avion choisi.
                            </span>

                        </div>

                    </div>

                </div>


                <!-- SECTION 5 : STATUT -->

                <div class="form-section">

                    <div class="section-heading">

                        <div class="section-icon">◉</div>

                        <div>
                            <h3>Statut du vol</h3>
                            <p>Définissez l'état actuel du vol.</p>
                        </div>

                    </div>

                    <div class="form-grid">

                        <div class="form-group">

                            <label for="status">
                                Statut <span class="required">*</span>
                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-control"
                                required
                            >

                                <option
                                    value="scheduled"
                                    {{ old('status', 'scheduled') == 'scheduled' ? 'selected' : '' }}
                                >
                                    Programmé
                                </option>

                                <option
                                    value="in_progress"
                                    {{ old('status') == 'in_progress' ? 'selected' : '' }}
                                >
                                    En cours
                                </option>

                                <option
                                    value="completed"
                                    {{ old('status') == 'completed' ? 'selected' : '' }}
                                >
                                    Terminé
                                </option>

                                <option
                                    value="cancelled"
                                    {{ old('status') == 'cancelled' ? 'selected' : '' }}
                                >
                                    Annulé
                                </option>

                            </select>

                            @error('status')
                                <span class="field-error">{{ $message }}</span>
                            @enderror

                        </div>

                    </div>

                </div>


                <!-- BOUTONS -->

                <div class="form-actions">

                    <a
                        href="{{ route('admin.flights.index') }}"
                        class="btn btn-reset"
                    >
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-primary">
                        ✓ Enregistrer le vol
                    </button>

                </div>

            </section>

        </form>

    </main>

</div>

</body>
</html>