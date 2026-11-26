<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un membre | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fa;
            color: #172b4d;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #0c233c;
            color: white;
            padding: 25px 16px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .logo {
            font-size: 21px;
            font-weight: 800;
            padding: 0 12px;
            margin-bottom: 38px;
        }

        .logo span {
            color: #60a5fa;
        }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            margin: 25px 12px 12px;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 5px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #1d4ed8;
            color: white;
        }

        /* MAIN */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0 35px;
            gap: 20px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 13px;
        }

        .admin-name {
            font-size: 13px;
            font-weight: 700;
        }

        .admin-role {
            font-size: 11px;
            color: #64748b;
            margin-top: 3px;
        }

        .logout {
            text-decoration: none;
            color: #dc2626;
            border: 1px solid #fecaca;
            padding: 9px 13px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
        }

        .logout:hover {
            background: #fef2f2;
        }

        .content {
            padding: 35px;
            max-width: 1200px;
        }

        .breadcrumb {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .breadcrumb a {
            color: #1d4ed8;
            text-decoration: none;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            font-weight: 800;
            color: #0c233c;
        }

        .page-heading p {
            color: #64748b;
            font-size: 13px;
            margin-top: 7px;
        }

        .btn-back {
            text-decoration: none;
            background: white;
            border: 1px solid #dbe2ea;
            color: #334155;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-back:hover {
            background: #f1f5f9;
        }

        /* FORM */
        .form-card {
            background: white;
            border-radius: 13px;
            padding: 30px;
            border: 1px solid #e8edf3;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .03);
        }

        .section-title {
            font-size: 15px;
            font-weight: 800;
            color: #0c233c;
            margin-bottom: 20px;
            padding-bottom: 13px;
            border-bottom: 1px solid #edf0f4;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 12px;
            font-weight: 700;
            color: #334155;
        }

        label span {
            color: #dc2626;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 13px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            color: #334155;
            background: white;
            transition: .2s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, .08);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .hint {
            color: #94a3b8;
            font-size: 11px;
        }

        .error {
            color: #dc2626;
            font-size: 11px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 14px 16px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 22px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #edf0f4;
        }

        .btn-cancel {
            text-decoration: none;
            padding: 12px 20px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            color: #475569;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-submit {
            border: none;
            background: #1d4ed8;
            color: white;
            padding: 12px 22px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-submit:hover {
            background: #1e40af;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
                width: calc(100% - 210px);
            }

            .content {
                padding: 20px;
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-heading {
                align-items: flex-start;
                gap: 15px;
                flex-direction: column;
            }

            .topbar {
                padding: 0 15px;
            }

            .content {
                padding: 18px;
            }

            .form-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            ✈ FLIGHT <span>MANAGER</span>
        </div>

        <div class="menu-title">Administration</div>

        <nav class="menu">
            <a href="{{ route('admin.dashboard') }}">▦ Tableau de bord</a>
            <a href="{{ route('admin.flights.index') }}">✈ Gestion des vols</a>
            <a href="{{ route('admin.aircraft.index') }}">▣ Gestion des avions</a>
            <a href="{{ route('admin.reservations.index') }}">▤ Réservations</a>
            <a href="{{ route('admin.users.index') }}">♙ Utilisateurs</a>
            <a href="{{ route('admin.baggage.index') }}">▢ Bagages</a>
            <a href="{{ route('admin.crew.index') }}" class="active">♟ Équipages</a>
        </nav>

    </aside>

    <!-- MAIN -->
    <main class="main">

        <header class="topbar">

            <div class="admin-info">
                <div class="admin-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                    <div class="admin-role">Administrateur</div>
                </div>
            </div>

            <a href="{{ route('admin.logout') }}"
               class="logout"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>

        </header>

        <div class="content">

            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Tableau de bord</a>
                /
                <a href="{{ route('admin.crew.index') }}">Gestion des équipages</a>
                / Ajouter un membre
            </div>

            <div class="page-heading">

                <div>
                    <h1>Ajouter un membre d'équipage</h1>
                    <p>Enregistrez un nouveau membre dans votre personnel navigant ou technique.</p>
                </div>

                <a href="{{ route('admin.crew.index') }}" class="btn-back">
                    ← Retour aux équipages
                </a>

            </div>

            <div class="form-card">

                @if ($errors->any())
                    <div class="alert-error">
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul style="margin: 10px 0 0 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.crew.store') }}" method="POST">

                    @csrf

                    <div class="section-title">
                        Informations personnelles et professionnelles
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="employee_number">Matricule professionnel <span>*</span></label>
                            <input
                                type="text"
                                id="employee_number"
                                name="employee_number"
                                value="{{ old('employee_number') }}"
                                placeholder="Ex : EQP-001"
                                required
                            >
                            @error('employee_number')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role">Fonction <span>*</span></label>
                            <select id="role" name="role" required>
                                <option value="">Sélectionner une fonction</option>
                                <option value="captain" {{ old('role') == 'captain' ? 'selected' : '' }}>Pilote commandant de bord</option>
                                <option value="first_officer" {{ old('role') == 'first_officer' ? 'selected' : '' }}>Copilote</option>
                                <option value="flight_attendant" {{ old('role') == 'flight_attendant' ? 'selected' : '' }}>Hôtesse / Steward</option>
                                <option value="chief_flight_attendant" {{ old('role') == 'chief_flight_attendant' ? 'selected' : '' }}>Chef de cabine</option>
                                <option value="technician" {{ old('role') == 'technician' ? 'selected' : '' }}>Technicien aéronautique</option>
                            </select>
                            @error('role')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="first_name">Prénom <span>*</span></label>
                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder="Prénom du membre"
                                required
                            >
                            @error('first_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name">Nom <span>*</span></label>
                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder="Nom du membre"
                                required
                            >
                            @error('last_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse e-mail <span>*</span></label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="exemple@email.com"
                                required
                            >
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Téléphone <span>*</span></label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="+237 6XX XXX XXX"
                                required
                            >
                            @error('phone')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="license_number">Numéro de licence professionnelle</label>
                            <input
                                type="text"
                                id="license_number"
                                name="license_number"
                                value="{{ old('license_number') }}"
                                placeholder="Numéro de licence"
                            >
                            <span class="hint">Obligatoire uniquement selon la fonction exercée.</span>
                            @error('license_number')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="hire_date">Date de recrutement</label>
                            <input
                                type="date"
                                id="hire_date"
                                name="hire_date"
                                value="{{ old('hire_date') }}"
                                max="{{ date('Y-m-d') }}"
                            >
                            @error('hire_date')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Statut professionnel <span>*</span></label>
                            <select id="status" name="status" required>
                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                                <option value="on_leave" {{ old('status') == 'on_leave' ? 'selected' : '' }}>En congé</option>
                                <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                            </select>
                            @error('status')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group full">
                            <label for="notes">Observations et informations complémentaires</label>
                            <textarea
                                id="notes"
                                name="notes"
                                placeholder="Ajoutez ici des informations complémentaires sur le membre..."
                            >{{ old('notes') }}</textarea>
                            @error('notes')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-actions">

                        <a href="{{ route('admin.crew.index') }}" class="btn-cancel">
                            Annuler
                        </a>

                        <button type="submit" class="btn-submit">
                            + Enregistrer le membre
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

</div>

</body>
</html>