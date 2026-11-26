<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des équipages | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --sidebar-bg: #0c233c;
            --sidebar-active: #1d4ed8;
            --bg-page: #f5f7fa;
            --surface: #fff;
            --text-main: #0f294a;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --blue: #1d5fd6;
            --blue-hover: #1749a8;
            --green-bg: #dcfce7;
            --green-text: #15803d;
            --amber-bg: #fef3c7;
            --amber-text: #b45309;
            --red-bg: #fee2e2;
            --red-text: #b91c1c;
            --gray-bg: #f1f5f9;
            --gray-text: #64748b;
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
        }

        .brand-text span {
            font-size: 9px;
            color: #93a8be;
            margin-top: 2px;
            letter-spacing: 1px;
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
            color: #cbd5e1;
            transition: .2s;
        }

        .nav-item:hover {
            background: rgba(255,255,255,.06);
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
            min-width: 0;
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
            gap: 16px;
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
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-meta strong {
            display: block;
            font-size: 11px;
        }

        .admin-meta span {
            display: block;
            font-size: 9.5px;
            color: var(--text-muted);
        }

        .logout-btn {
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 6px;
            padding: 7px 12px;
            font-size: 10.5px;
            font-weight: 700;
            cursor: pointer;
        }

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

        .panel-card {
            background: white;
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 20px 22px;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(15,41,74,.02);
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
            margin-bottom: 3px;
        }

        .card-subtitle {
            font-size: 10.5px;
            color: var(--text-muted);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(150px, 1fr)) auto;
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
            height: 38px;
            border: 1px solid #dce4ee;
            border-radius: 7px;
            padding: 0 11px;
            background: white;
            color: var(--text-main);
            font-size: 11px;
            outline: none;
        }

        .field-input:focus,
        .field-select:focus {
            border-color: var(--blue);
        }

        .btn-blue {
            min-height: 36px;
            padding: 0 18px;
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

        .btn-blue:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .crew-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 1050px;
            font-size: 11px;
        }

        .crew-table thead th {
            text-align: left;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .4px;
            color: var(--text-muted);
            text-transform: uppercase;
            background: #f8fafc;
            padding: 12px;
        }

        .crew-table tbody td {
            padding: 13px 12px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            vertical-align: middle;
        }

        .matricule-cell {
            font-weight: 700;
            color: var(--text-main);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 68px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 700;
        }

        .badge.active {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .badge.in-flight {
            background: #e0e7ff;
            color: #1d4ed8;
        }

        .badge.maintenance {
            background: var(--amber-bg);
            color: var(--amber-text);
        }

        .badge.inactive {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .badge.suspended {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .badge.cancelled {
            background: var(--red-bg);
            color: var(--red-text);
        }

        .badge.confirmed {
            background: var(--green-bg);
            color: var(--green-text);
        }

        .badge.assigned {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge.completed {
            background: var(--gray-bg);
            color: var(--gray-text);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 11px;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
        }

        .btn-edit:hover {
            background: #dbeafe;
        }

        .btn-delete {
            padding: 7px 11px;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fee2e2;
        }

        .pagination-container {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
        }

        .empty-message {
            text-align: center;
            padding: 34px 14px;
            color: var(--text-muted);
        }

        .assignment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-top: 20px;
        }

        .assignment-help {
            margin-top: 15px;
            padding: 12px 14px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            color: #1e40af;
            font-size: 10.5px;
            line-height: 1.6;
        }

        .assignment-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .field-error {
            display: block;
            color: #dc2626;
            font-size: 10px;
            margin-top: 5px;
        }

        /* NOUVEAU : liste détaillée des affectations */

        .flight-group {
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            margin-top: 16px;
            overflow: hidden;
        }

        .flight-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 17px;
            background: #f8fafc;
            border-bottom: 1px solid var(--border-soft);
        }

        .flight-group-header strong {
            display: block;
            font-size: 12px;
            color: var(--text-main);
        }

        .flight-group-header span {
            display: block;
            font-size: 10px;
            color: var(--text-muted);
            margin-top: 5px;
        }

        .flight-reference {
            display: inline-flex;
            align-items: center;
            padding: 6px 10px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
        }

        .assignment-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
            font-size: 11px;
        }

        .assignment-table th {
            padding: 11px 13px;
            text-align: left;
            font-size: 9px;
            color: var(--text-muted);
            background: white;
            text-transform: uppercase;
            border-bottom: 1px solid var(--border-soft);
        }

        .assignment-table td {
            padding: 12px 13px;
            border-bottom: 1px solid #f1f5f9;
            color: #334e68;
            vertical-align: middle;
        }

        .assignment-table tr:last-child td {
            border-bottom: none;
        }

        .crew-name {
            font-weight: 700;
            color: var(--text-main);
        }

        .crew-role {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 9.5px;
            font-weight: 700;
        }

        .btn-cancel-assignment {
            padding: 7px 10px;
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
            border-radius: 6px;
            font-size: 9.5px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel-assignment:hover {
            background: #fee2e2;
        }

        .cancelled-message {
            font-size: 10px;
            color: #b91c1c;
            font-weight: 700;
        }

        .empty-state {
            padding: 35px 15px;
            text-align: center;
            color: var(--text-muted);
            font-size: 11px;
        }

        @media(max-width: 1024px) {
            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width: 768px) {
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
            }

            .topbar-right {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }

            .filter-grid,
            .assignment-grid {
                grid-template-columns: 1fr;
            }

            .panel-top-row {
                flex-direction: column;
            }

            .flight-group-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

@php
    $adminName = auth()->user()->name ?? 'Admin';
    $nameParts = preg_split('/\s+/', trim($adminName));

    $initials = strtoupper(
        substr($nameParts[0] ?? 'A', 0, 1) .
        (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : 'D')
    );

    $availabilityFilter = request('status');

    $roleLabels = [
        'captain' => 'Pilote',
        'first_officer' => 'Copilote',
        'flight_attendant' => 'Hôtesse / Steward',
        'chief_flight_attendant' => 'Chef de cabine',
        'technician' => 'Technicien',
    ];

    $assignmentStatusLabels = [
        'assigned' => 'Affecté',
        'confirmed' => 'Confirmé',
        'completed' => 'Terminé',
        'cancelled' => 'Annulé',
    ];
@endphp

<aside class="sidebar">

    <div>
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <span class="brand-mark">✈</span>
            <span class="brand-text">
                <strong>FLIGHT</strong>
                <span>MANAGER</span>
            </span>
        </a>

        <div class="nav-group-label">MENU PRINCIPAL</div>

        <nav class="nav-list">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">▦ Vue d'ensemble</a>
            <a href="{{ route('admin.flights.index') }}" class="nav-item">✈ Gestion des vols</a>
            <a href="{{ route('admin.aircraft.index') }}" class="nav-item">▣ Avions &amp; destinations</a>
            <a href="{{ route('admin.reservations.index') }}" class="nav-item">▤ Réservations</a>
            <a href="{{ route('admin.users.index') }}" class="nav-item">♙ Utilisateurs</a>
            <a href="{{ route('admin.baggage.index') }}" class="nav-item">▢ Bagages</a>
            <a href="{{ route('admin.crew.index') }}" class="nav-item active">♟ Équipages</a>
            <a href="{{ route('admin.settings.index') }}" class="nav-item">⚙ Paramètres système</a>
        </nav>
    </div>

    <div class="sidebar-footer">
        <div class="nav-group-label">ESPACE ADMINISTRATEUR</div>
        <a href="{{ route('admin.dashboard') }}" class="control-center-link">
            Centre de contrôle
        </a>
    </div>

</aside>

<div class="main-wrapper">

    <header class="topbar">

        <div>
            <div class="breadcrumb">Administration / Gestion des équipages</div>
            <h1 class="topbar-title">Gestion des équipages</h1>
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
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>

        </div>

    </header>

    <main class="content">

        <p class="page-subtitle">
            Gérez les personnels de bord, les équipes de maintenance et les affectations aux vols.
        </p>

        {{-- MESSAGES DE RETOUR --}}

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
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul style="margin:8px 0 0 18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- FILTRES --}}

        <section class="panel-card">

            <h2 class="card-title">Gestion des équipes</h2>

            <p class="card-subtitle">
                Recherchez et filtrez les personnels navigants et techniques.
            </p>

            <form action="{{ route('admin.crew.index') }}" method="GET" class="filter-grid">

                <div class="field-group">
                    <label for="search">Rechercher un membre</label>
                    <input
                        id="search"
                        type="text"
                        name="search"
                        class="field-input"
                        placeholder="Nom ou matricule"
                        value="{{ request('search') }}"
                    >
                </div>

                <div class="field-group">
                    <label for="role">Fonction</label>
                    <select id="role" name="role" class="field-select">
                        <option value="">Toutes les fonctions</option>
                        <option value="captain" @selected(request('role') === 'captain')>Pilote</option>
                        <option value="first_officer" @selected(request('role') === 'first_officer')>Copilote</option>
                        <option value="flight_attendant" @selected(request('role') === 'flight_attendant')>Hôtesse / Steward</option>
                        <option value="chief_flight_attendant" @selected(request('role') === 'chief_flight_attendant')>Chef de cabine</option>
                        <option value="technician" @selected(request('role') === 'technician')>Technicien</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="status">Disponibilité</label>
                    <select id="status" name="status" class="field-select">
                        <option value="">Toutes</option>
                        <option value="active" @selected($availabilityFilter === 'active')>Disponible</option>
                        <option value="on_leave" @selected($availabilityFilter === 'on_leave')>En congé</option>
                        <option value="inactive" @selected($availabilityFilter === 'inactive')>Inactif</option>
                        <option value="suspended" @selected($availabilityFilter === 'suspended')>Suspendu</option>
                    </select>
                </div>

                <button type="submit" class="btn-blue">Filtrer</button>

            </form>

        </section>


        {{-- LISTE DU PERSONNEL --}}

        <section class="panel-card">

            <div class="panel-top-row">

                <div>
                    <h2 class="card-title">Personnel et équipages</h2>
                    <p class="card-subtitle">
                        Pilotes, copilotes, hôtesses, stewards et techniciens.
                    </p>
                </div>

                <a href="{{ route('admin.crew.create') }}" class="btn-blue">
                    + Ajouter membre
                </a>

            </div>

            <div class="table-responsive">

                <table class="crew-table">

                    <thead>
                        <tr>
                            <th>MATRICULE</th>
                            <th>NOM</th>
                            <th>FONCTION</th>
                            <th>QUALIFICATION</th>
                            <th>DISPONIBILITÉ</th>
                            <th>AFFECTATION</th>
                            <th>STATUT</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($crewMembers as $member)

                            @php
                                $roleLabel = $roleLabels[$member->role] ?? ucfirst((string) $member->role);

                                $defaultQual = match($member->role) {
                                    'captain' => 'Commandant A320',
                                    'first_officer' => 'A320 / A319',
                                    'flight_attendant', 'chief_flight_attendant' => 'Cabine',
                                    'technician' => 'Moteurs & systèmes',
                                    default => 'Certifié',
                                };

                                $qualification = $member->license_number ?: $defaultQual;
                                $st = strtolower((string) $member->status);

                                if ($st === 'on_leave') {
                                    $availLabel = 'En congé';
                                    $availClass = 'maintenance';
                                } elseif ($st === 'active' && ($member->assignments_count ?? 0) > 0 && $member->role !== 'technician') {
                                    $availLabel = 'Affecté';
                                    $availClass = 'in-flight';
                                } elseif ($st === 'active') {
                                    $availLabel = 'Disponible';
                                    $availClass = 'active';
                                } else {
                                    $availLabel = 'Indisponible';
                                    $availClass = 'inactive';
                                }

                                [$statusLabel, $statusClass] = match($st) {
                                    'active' => ['Actif', 'active'],
                                    'on_leave' => ['En congé', 'maintenance'],
                                    'suspended' => ['Suspendu', 'suspended'],
                                    default => ['Inactif', 'inactive'],
                                };
                            @endphp

                            <tr>

                                <td class="matricule-cell">
                                    {{ $member->employee_number }}
                                </td>

                                <td>{{ $member->full_name }}</td>

                                <td>{{ $roleLabel }}</td>

                                <td>{{ $qualification }}</td>

                                <td>
                                    <span class="badge {{ $availClass }}">
                                        {{ $availLabel }}
                                    </span>
                                </td>

                                <td>{{ $member->assignments_count }} vol(s)</td>

                                <td>
                                    <span class="badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">

                                        <a
                                            href="{{ route('admin.crew.edit', $member) }}"
                                            class="btn-edit"
                                        >
                                            ✏ Modifier
                                        </a>

                                        <form
                                            action="{{ route('admin.crew.destroy', $member) }}"
                                            method="POST"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce membre ?');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn-delete">
                                                🗑 Supprimer
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="empty-message">
                                    Aucun membre d'équipage enregistré pour le moment.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            @if($crewMembers->hasPages())
                <div class="pagination-container">
                    {{ $crewMembers->links() }}
                </div>
            @endif

        </section>


        {{-- AFFECTATION DES ÉQUIPAGES --}}

        <section class="panel-card">

            <div class="panel-top-row">
                <div>
                    <h2 class="card-title">✈ Affectation d'un équipage</h2>
                    <p class="card-subtitle">
                        Affectez un membre actif à un vol programmé.
                    </p>
                </div>
            </div>

            @if($availableFlights->isEmpty())
                <div class="alert alert-error">
                    Aucun vol programmé disponible pour le moment.
                    Vérifiez que vos vols ont le statut « scheduled » et une date de départ future.
                </div>
            @endif

            @if($availableCrewMembers->isEmpty())
                <div class="alert alert-error">
                    Aucun membre navigant actif disponible.
                    Ajoutez un pilote, un copilote, une hôtesse ou un chef de cabine avec le statut actif.
                </div>
            @endif

            <form
                action="{{ route('admin.crew.assignments.store') }}"
                method="POST"
            >

                @csrf

                <div class="assignment-grid">

                    <div class="field-group">
                        <label for="flight_id">Vol à affecter *</label>

                        <select
                            name="flight_id"
                            id="flight_id"
                            class="field-select"
                            required
                        >
                            <option value="">Sélectionner un vol</option>

                            @foreach($availableFlights as $flight)
                                <option
                                    value="{{ $flight->id }}"
                                    @selected(old('flight_id') == $flight->id)
                                >
                                    {{ $flight->flight_number }}
                                    —
                                    {{ $flight->departureAirport->city ?? 'Départ' }}
                                    →
                                    {{ $flight->arrivalAirport->city ?? 'Arrivée' }}
                                    —
                                    {{ $flight->departure_at->format('d/m/Y H:i') }}
                                </option>
                            @endforeach

                        </select>

                        @error('flight_id')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label for="crew_member_id">Membre d'équipage *</label>

                        <select
                            name="crew_member_id"
                            id="crew_member_id"
                            class="field-select"
                            required
                        >
                            <option value="">Sélectionner un membre</option>

                            @foreach($availableCrewMembers as $member)
                                <option
                                    value="{{ $member->id }}"
                                    @selected(old('crew_member_id') == $member->id)
                                >
                                    {{ $member->first_name }}
                                    {{ $member->last_name }}
                                    —
                                    {{ $roleLabels[$member->role] ?? $member->role }}
                                </option>
                            @endforeach

                        </select>

                        @error('crew_member_id')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="assignment-help">
                    <strong>Information :</strong>
                    le rôle de l'affectation est automatiquement déterminé à partir
                    de la fonction du membre sélectionné. Un membre déjà affecté
                    à un autre vol sur la même période ne pourra pas être affecté.
                </div>

                <div class="assignment-actions">

                    <button
                        type="submit"
                        class="btn-blue"
                        @disabled($availableFlights->isEmpty() || $availableCrewMembers->isEmpty())
                    >
                        ✈ Enregistrer l'affectation
                    </button>

                </div>

            </form>

        </section>


        {{-- NOUVELLE SECTION : LISTE DÉTAILLÉE DES AFFECTATIONS --}}

        <section class="panel-card">

            <div class="panel-top-row">

                <div>
                    <h2 class="card-title">📋 Liste détaillée des affectations</h2>

                    <p class="card-subtitle">
                        Consultez les équipages affectés à chaque vol et gérez leurs affectations.
                    </p>
                </div>

                <span class="flight-reference">
                    {{ $crewAssignments->count() }} affectation(s)
                </span>

            </div>

            @php
                $groupedAssignments = $crewAssignments->groupBy('flight_id');
            @endphp

            @forelse($groupedAssignments as $flightAssignments)

                @php
                    $flight = $flightAssignments->first()->flight;
                @endphp

                @if($flight)

                    <div class="flight-group">

                        {{-- INFORMATIONS DU VOL --}}

                        <div class="flight-group-header">

                            <div>
                                <strong>
                                    ✈ Vol {{ $flight->flight_number }}
                                </strong>

                                <span>
                                    {{ $flight->departureAirport->city ?? 'Départ inconnu' }}
                                    →
                                    {{ $flight->arrivalAirport->city ?? 'Arrivée inconnue' }}
                                    &nbsp; | &nbsp;

                                    {{ $flight->departure_at
                                        ? $flight->departure_at->format('d/m/Y à H:i')
                                        : 'Date inconnue'
                                    }}
                                </span>
                            </div>

                            <span class="flight-reference">
                                {{ $flightAssignments->count() }} membre(s)
                            </span>

                        </div>

                        {{-- MEMBRES AFFECTÉS À CE VOL --}}

                        <div class="table-responsive">

                            <table class="assignment-table">

                                <thead>
                                    <tr>
                                        <th>MATRICULE</th>
                                        <th>MEMBRE D'ÉQUIPAGE</th>
                                        <th>FONCTION</th>
                                        <th>DATE D'AFFECTATION</th>
                                        <th>STATUT</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($flightAssignments as $assignment)

                                        @php
                                            $member = $assignment->crewMember;

                                            $assignmentStatus = $assignment->status;

                                            $assignmentStatusClass = match($assignmentStatus) {
                                                'assigned' => 'assigned',
                                                'confirmed' => 'confirmed',
                                                'completed' => 'completed',
                                                'cancelled' => 'cancelled',
                                                default => 'inactive',
                                            };

                                            $assignmentRole = $roleLabels[$assignment->assignment_role]
                                                ?? $assignment->assignment_role;
                                        @endphp

                                        <tr>

                                            <td class="matricule-cell">
                                                {{ $member->employee_number ?? '—' }}
                                            </td>

                                            <td class="crew-name">
                                                @if($member)
                                                    {{ $member->first_name }} {{ $member->last_name }}
                                                @else
                                                    Membre supprimé
                                                @endif
                                            </td>

                                            <td>
                                                <span class="crew-role">
                                                    {{ $assignmentRole }}
                                                </span>
                                            </td>

                                            <td>
                                                {{ $assignment->assigned_at
                                                    ? $assignment->assigned_at->format('d/m/Y H:i')
                                                    : '—'
                                                }}
                                            </td>

                                            <td>
                                                <span class="badge {{ $assignmentStatusClass }}">
                                                    {{ $assignmentStatusLabels[$assignmentStatus] ?? $assignmentStatus }}
                                                </span>
                                            </td>

                                            <td>

                                                @if(in_array($assignmentStatus, ['assigned', 'confirmed']))

                                                    <form
                                                        action="{{ route('admin.crew.assignments.cancel', $assignment) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Voulez-vous vraiment annuler cette affectation ?');"
                                                    >

                                                        @csrf

                                                        <button
                                                            type="submit"
                                                            class="btn-cancel-assignment"
                                                        >
                                                            ✕ Annuler
                                                        </button>

                                                    </form>

                                                @elseif($assignmentStatus === 'cancelled')

                                                    <span class="cancelled-message">
                                                        Affectation annulée
                                                    </span>

                                                @else

                                                    <span style="font-size:10px;color:#64748b;">
                                                        Affectation terminée
                                                    </span>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                @endif

            @empty

                <div class="empty-state">
                    <div style="font-size:28px;margin-bottom:10px;">✈</div>

                    <strong>Aucune affectation enregistrée</strong>

                    <p style="margin-top:7px;">
                        Les affectations des pilotes, copilotes et personnels de cabine apparaîtront ici.
                    </p>
                </div>

            @endforelse

        </section>

    </main>

</div>

</body>
</html>