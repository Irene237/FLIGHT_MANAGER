<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un avion | FLIGHT MANAGER</title>

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
            color: #0f294a;
        }

        .sidebar {
            width: 224px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0c233c;
            color: white;
            padding: 25px 16px;
        }

        .brand {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 45px;
            padding-left: 10px;
        }

        .brand span {
            color: #60a5fa;
        }

        .nav-title {
            font-size: 10px;
            color: #91a4ba;
            margin: 25px 10px 12px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .nav-link {
            display: block;
            text-decoration: none;
            color: #c4d0df;
            padding: 12px 13px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #1d4ed8;
            color: white;
        }

        .main {
            margin-left: 224px;
            min-height: 100vh;
        }

        .topbar {
            height: 76px;
            background: white;
            border-bottom: 1px solid #e6ecf3;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .topbar-title {
            font-size: 13px;
            font-weight: 700;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .admin-profile {
            font-size: 12px;
            font-weight: 700;
        }

        .admin-profile small {
            display: block;
            color: #718296;
            font-weight: 400;
            margin-top: 4px;
        }

        .topbar-logout-form {
            display: inline-flex;
            margin: 0;
        }

        .logout-button {
            background: #fff;
            border: 1px solid #e6ecf3;
            color: #dc2626;
            padding: 9px 13px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .logout-button:hover {
            background: #fef2f2;
        }

        .content {
            padding: 28px;
            max-width: 1100px;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 22px;
            margin-bottom: 7px;
        }

        .page-heading p {
            color: #718296;
            font-size: 12px;
        }

        .back-button {
            text-decoration: none;
            color: #1d5fd6;
            background: white;
            border: 1px solid #e6ecf3;
            padding: 10px 15px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .card {
            background: white;
            border: 1px solid #e6ecf3;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 12px rgba(15, 41, 74, 0.03);
        }

        .card h2 {
            font-size: 15px;
            margin-bottom: 7px;
        }

        .card-description {
            font-size: 11px;
            color: #718296;
            margin-bottom: 25px;
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

        label {
            font-size: 11px;
            font-weight: 700;
        }

        input, select {
            width: 100%;
            height: 42px;
            border: 1px solid #e6ecf3;
            border-radius: 7px;
            padding: 0 12px;
            font-family: inherit;
            font-size: 11px;
            color: #0f294a;
            outline: none;
            background: white;
        }

        input:focus, select:focus {
            border-color: #1d5fd6;
            box-shadow: 0 0 0 3px rgba(29, 95, 214, 0.08);
        }

        .error {
            color: #dc2626;
            font-size: 10px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #e6ecf3;
        }

        .cancel-button {
            text-decoration: none;
            color: #52657c;
            background: #f5f7fa;
            padding: 12px 18px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .primary-button {
            border: none;
            background: #1d5fd6;
            color: white;
            padding: 12px 20px;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .primary-button:hover {
            background: #174bb0;
        }

        .alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 11px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 65px;
                padding: 20px 7px;
            }

            .brand {
                font-size: 11px;
                padding: 0;
                text-align: center;
            }

            .nav-title {
                display: none;
            }

            .nav-link {
                font-size: 0;
                text-align: center;
                padding: 13px 5px;
            }

            .main {
                margin-left: 65px;
            }

            .content {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 15px;
            }

            .admin-profile {
                display: none;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="brand">
            ✈ FLIGHT <span>MANAGER</span>
        </div>

        <div class="nav-title">Menu principal</div>

        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            ▦ Vue d'ensemble
        </a>

        <a href="{{ route('admin.flights.index') }}" class="nav-link">
            ✈ Gestion des vols
        </a>

        <a href="{{ route('admin.aircraft.index') }}" class="nav-link active">
            ▣ Avions & destinations
        </a>

        <div class="nav-title">Gestion</div>

        <a href="#" class="nav-link">▤ Réservations</a>
        <a href="#" class="nav-link">♙ Utilisateurs</a>
        <a href="#" class="nav-link">▣ Bagages</a>
        <a href="#" class="nav-link">♧ Équipages</a>
        <a href="#" class="nav-link">⚙ Paramètres système</a>

    </aside>

    <main class="main">

        <header class="topbar">

            <div class="topbar-title">
                Administration / Avions & destinations / Ajouter un avion
            </div>

            <div class="topbar-right">

                <div class="admin-profile">
                    {{ Auth::user()->name }}
                    <small>Administrateur</small>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST" class="topbar-logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        ↪ Déconnexion
                    </button>
                </form>

            </div>

        </header>

        <section class="content">

            <div class="page-heading">

                <div>
                    <h1>Ajouter un avion</h1>
                    <p>Enregistrer un nouvel appareil dans le parc aérien.</p>
                </div>

                <a href="{{ route('admin.aircraft.index') }}" class="back-button">
                    ← Retour aux avions
                </a>

            </div>

            <div class="card">

                <h2>Informations de l'appareil</h2>

                <p class="card-description">
                    Renseignez les informations nécessaires pour enregistrer cet avion.
                </p>

                @if ($errors->any())
                    <div class="alert">
                        <strong>Veuillez corriger les erreurs suivantes :</strong>
                        <ul style="margin: 8px 0 0 18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.aircraft.store') }}" method="POST">

                    @csrf

                    <div class="form-grid">

                        <div class="form-group">
                            <label for="registration_number">Numéro d'immatriculation *</label>
                            <input
                                type="text"
                                id="registration_number"
                                name="registration_number"
                                value="{{ old('registration_number') }}"
                                placeholder="Ex : TJ-ABC"
                                required
                            >
                            @error('registration_number')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="model">Modèle de l'avion *</label>
                            <input
                                type="text"
                                id="model"
                                name="model"
                                value="{{ old('model') }}"
                                placeholder="Ex : Boeing 737-800"
                                required
                            >
                            @error('model')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="manufacturer">Constructeur *</label>
                            <input
                                type="text"
                                id="manufacturer"
                                name="manufacturer"
                                value="{{ old('manufacturer') }}"
                                placeholder="Ex : Boeing"
                                required
                            >
                            @error('manufacturer')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="capacity">Capacité en sièges *</label>
                            <input
                                type="number"
                                id="capacity"
                                name="capacity"
                                value="{{ old('capacity') }}"
                                min="1"
                                placeholder="Ex : 180"
                                required
                            >
                            @error('capacity')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Statut de l'avion *</label>

                            <select name="status" id="status" required>
                                <option value="">Choisir un statut</option>

                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                    Disponible
                                </option>

                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>
                                    En maintenance
                                </option>

                                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>
                                    Indisponible
                                </option>
                            </select>

                            @error('status')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="form-actions">

                        <a href="{{ route('admin.aircraft.index') }}" class="cancel-button">
                            Annuler
                        </a>

                        <button type="submit" class="primary-button">
                            + Enregistrer l'avion
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</body>
</html>