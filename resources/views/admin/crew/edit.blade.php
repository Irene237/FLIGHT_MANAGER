<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un membre | FLIGHT MANAGER</title>

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
            color: #1e293b;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100vh;
            background: #0c233c;
            color: white;
            padding: 25px 18px;
        }

        .brand {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 40px;
        }

        .brand span {
            color: #60a5fa;
        }

        .menu-title {
            font-size: 11px;
            color: #94a3b8;
            margin: 25px 10px 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #cbd5e1;
            padding: 13px 14px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-size: 13px;
        }

        .menu a:hover,
        .menu a.active {
            background: #1d4ed8;
            color: white;
        }

        .main {
            margin-left: 250px;
            padding: 30px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h2 {
            font-size: 23px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #1d4ed8;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
            max-width: 1000px;
        }

        .card-header {
            margin-bottom: 28px;
        }

        .card-header h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .card-header p {
            color: #64748b;
            font-size: 13px;
        }

        .alert {
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
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
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29,78,216,.1);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .error-text {
            color: #dc2626;
            font-size: 12px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #1d4ed8;
            color: white;
        }

        .btn-primary:hover {
            background: #1e40af;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover {
            background: #cbd5e1;
        }

        .logout {
            color: #fca5a5 !important;
            margin-top: 30px;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 200px;
            }

            .main {
                margin-left: 200px;
                padding: 25px;
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 20px;
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

<aside class="sidebar">
    <div class="brand">✈ FLIGHT <span>MANAGER</span></div>

    <div class="menu-title">Menu principal</div>

    <nav class="menu">
        <a href="{{ route('admin.dashboard') }}">▦ Tableau de bord</a>
        <a href="{{ route('admin.flights.index') }}">✈ Gestion des vols</a>
        <a href="{{ route('admin.aircraft.index') }}">▣ Gestion des avions</a>
        <a href="{{ route('admin.reservations.index') }}">▤ Réservations</a>
        <a href="{{ route('admin.users.index') }}">♙ Utilisateurs</a>
        <a href="{{ route('admin.baggage.index') }}">▣ Bagages</a>
        <a href="{{ route('admin.crew.index') }}" class="active">♟ Équipages</a>
    </nav>

    <div class="menu-title">Compte</div>

    <nav class="menu">
        <a href="#" class="logout"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            ↪ Déconnexion
        </a>
    </nav>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</aside>

<main class="main">

    <header class="topbar">
        <div>
            <h2>Modifier un membre</h2>
            <p style="color:#64748b;font-size:13px;margin-top:6px;">
                Mise à jour des informations de l'équipage
            </p>
        </div>

        <div class="admin-info">
            Administrateur
            <div class="avatar">AD</div>
        </div>
    </header>

    <section class="card">

        <div class="card-header">
            <h3>Informations du membre d'équipage</h3>
            <p>Modifiez les informations de {{ $crewMember->full_name }}.</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul style="margin:8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.crew.update', $crewMember) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="employee_number">Matricule *</label>
                    <input
                        type="text"
                        id="employee_number"
                        name="employee_number"
                        value="{{ old('employee_number', $crewMember->employee_number) }}"
                        required
                    >
                    @error('employee_number')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Fonction *</label>
                    <select name="role" id="role" required>
                        <option value="captain" @selected(old('role', $crewMember->role) == 'captain')>Pilote commandant</option>
                        <option value="first_officer" @selected(old('role', $crewMember->role) == 'first_officer')>Copilote</option>
                        <option value="flight_attendant" @selected(old('role', $crewMember->role) == 'flight_attendant')>Hôtesse / Steward</option>
                        <option value="chief_flight_attendant" @selected(old('role', $crewMember->role) == 'chief_flight_attendant')>Chef de cabine</option>
                        <option value="technician" @selected(old('role', $crewMember->role) == 'technician')>Technicien</option>
                    </select>
                    @error('role')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="first_name">Prénom *</label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name', $crewMember->first_name) }}"
                        required
                    >
                    @error('first_name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Nom *</label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name', $crewMember->last_name) }}"
                        required
                    >
                    @error('last_name')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email', $crewMember->email) }}"
                        required
                    >
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Téléphone *</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $crewMember->phone) }}"
                        required
                    >
                    @error('phone')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="license_number">Numéro de licence</label>
                    <input
                        type="text"
                        id="license_number"
                        name="license_number"
                        value="{{ old('license_number', $crewMember->license_number) }}"
                    >
                    @error('license_number')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="hire_date">Date de recrutement</label>
                    <input
                        type="date"
                        id="hire_date"
                        name="hire_date"
                        value="{{ old('hire_date', $crewMember->hire_date?->format('Y-m-d')) }}"
                    >
                    @error('hire_date')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Statut *</label>
                    <select name="status" id="status" required>
                        <option value="active" @selected(old('status', $crewMember->status) == 'active')>Actif</option>
                        <option value="inactive" @selected(old('status', $crewMember->status) == 'inactive')>Inactif</option>
                        <option value="on_leave" @selected(old('status', $crewMember->status) == 'on_leave')>En congé</option>
                        <option value="suspended" @selected(old('status', $crewMember->status) == 'suspended')>Suspendu</option>
                    </select>
                    @error('status')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group full">
                    <label for="notes">Observations</label>
                    <textarea
                        name="notes"
                        id="notes"
                        placeholder="Informations complémentaires..."
                    >{{ old('notes', $crewMember->notes) }}</textarea>
                    @error('notes')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.crew.index') }}" class="btn btn-secondary">
                    Annuler
                </a>

                <button type="submit" class="btn btn-primary">
                    Enregistrer les modifications
                </button>
            </div>

        </form>

    </section>

</main>

</body>
</html>