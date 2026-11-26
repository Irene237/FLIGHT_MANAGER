<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un vol | FLIGHT MANAGER</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f7fb;
            color: #172b4d;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #0c233c;
            padding: 28px 18px;
            color: white;
        }

        .logo {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 45px;
            padding-left: 12px;
        }

        .menu-title {
            font-size: 11px;
            color: #8294a9;
            text-transform: uppercase;
            margin: 25px 12px 12px;
            letter-spacing: 1px;
        }

        .sidebar a {
            display: block;
            text-decoration: none;
            color: #b9c7d6;
            padding: 13px 14px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #1d4ed8;
            color: white;
        }

        .main {
            margin-left: 260px;
            padding: 30px 38px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .admin {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .logout {
            border: none;
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px 16px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: 600;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #718096;
            font-size: 13px;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 1050px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.04);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 22px;
            padding-bottom: 15px;
            border-bottom: 1px solid #edf0f5;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #dce3ec;
            border-radius: 7px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            background: white;
        }

        input:focus, select:focus {
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29,78,216,0.08);
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .alert {
            padding: 14px 16px;
            border-radius: 7px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #edf0f5;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
        }

        .btn-cancel {
            background: #edf2f7;
            color: #475569;
        }

        .btn-submit {
            background: #1d4ed8;
            color: white;
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
                padding: 25px;
            }
        }

        @media(max-width: 650px) {
            .sidebar {
                display: none;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

@php
    $adminName = auth()->user()->name ?? 'Administrateur';
@endphp

<aside class="sidebar">

    <div class="logo">✈ FLIGHT MANAGER</div>

    <div class="menu-title">Principal</div>

    <a href="{{ route('admin.dashboard') }}">▦ Tableau de bord</a>

    <div class="menu-title">Gestion aérienne</div>

    <a href="{{ route('admin.flights.index') }}" class="active">
        ✈ Gestion des vols
    </a>

    <a href="#">▣ Gestion des avions</a>
    <a href="#">⌖ Destinations</a>
    <a href="#">♙ Gestion des utilisateurs</a>
    <a href="#">▤ Réservations</a>
    <a href="#">▧ Gestion des bagages</a>
    <a href="#">♧ Gestion des équipages</a>

    <div class="menu-title">Configuration</div>

    <a href="#">⚙ Paramètres système</a>

</aside>

<main class="main">

    <header class="topbar">

        <div>
            <strong>Administration</strong>
        </div>

        <div class="admin">

            <div class="avatar">
                {{ strtoupper(substr($adminName, 0, 1)) }}
            </div>

            <span>{{ $adminName }}</span>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="logout">
                    Déconnexion
                </button>
            </form>

        </div>

    </header>

    <div class="page-heading">

        <h1>Modifier un vol</h1>

        <p>
            Modifiez les informations du vol
            {{ $flight->flight_number }}.
        </p>

    </div>

    <div class="form-card">

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Veuillez corriger les erreurs suivantes :</strong>

                <ul style="margin: 10px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="section-title">Informations du vol</h2>

        <form action="{{ route('admin.flights.update', $flight->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group">
                    <label for="flight_number">Numéro du vol</label>

                    <input
                        type="text"
                        id="flight_number"
                        name="flight_number"
                        value="{{ old('flight_number', $flight->flight_number) }}"
                        required
                    >

                    @error('flight_number')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="aircraft_id">Avion affecté</label>

                    <select name="aircraft_id" id="aircraft_id">
                        <option value="">Aucun avion sélectionné</option>

                        @foreach($aircraft as $plane)
                            <option
                                value="{{ $plane->id }}"
                                {{ old('aircraft_id', $flight->aircraft_id) == $plane->id ? 'selected' : '' }}
                            >
                                {{ $plane->registration_number }}
                                - {{ $plane->model }}
                                ({{ $plane->capacity }} places)
                            </option>
                        @endforeach

                    </select>

                    @error('aircraft_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="departure_airport_id">
                        Aéroport de départ
                    </label>

                    <select
                        name="departure_airport_id"
                        id="departure_airport_id"
                        required
                    >

                        <option value="">Choisir un aéroport</option>

                        @foreach($airports as $airport)
                            <option
                                value="{{ $airport->id }}"
                                {{ old('departure_airport_id', $flight->departure_airport_id) == $airport->id ? 'selected' : '' }}
                            >
                                {{ $airport->code }} -
                                {{ $airport->city }}
                            </option>
                        @endforeach

                    </select>

                    @error('departure_airport_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arrival_airport_id">
                        Aéroport d'arrivée
                    </label>

                    <select
                        name="arrival_airport_id"
                        id="arrival_airport_id"
                        required
                    >

                        <option value="">Choisir un aéroport</option>

                        @foreach($airports as $airport)
                            <option
                                value="{{ $airport->id }}"
                                {{ old('arrival_airport_id', $flight->arrival_airport_id) == $airport->id ? 'selected' : '' }}
                            >
                                {{ $airport->code }} -
                                {{ $airport->city }}
                            </option>
                        @endforeach

                    </select>

                    @error('arrival_airport_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="departure_at">
                        Date et heure de départ
                    </label>

                    <input
                        type="datetime-local"
                        id="departure_at"
                        name="departure_at"
                        value="{{ old('departure_at', \Illuminate\Support\Carbon::parse($flight->departure_at)->format('Y-m-d\TH:i')) }}"
                        required
                    >

                    @error('departure_at')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="arrival_at">
                        Date et heure d'arrivée
                    </label>

                    <input
                        type="datetime-local"
                        id="arrival_at"
                        name="arrival_at"
                        value="{{ old('arrival_at', \Illuminate\Support\Carbon::parse($flight->arrival_at)->format('Y-m-d\TH:i')) }}"
                        required
                    >

                    @error('arrival_at')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Prix du billet (FCFA)</label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        min="0"
                        step="0.01"
                        value="{{ old('price', $flight->price) }}"
                        required
                    >

                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="available_seats">
                        Nombre de places disponibles
                    </label>

                    <input
                        type="number"
                        id="available_seats"
                        name="available_seats"
                        min="0"
                        value="{{ old('available_seats', $flight->available_seats) }}"
                        required
                    >

                    @error('available_seats')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Statut du vol</label>

                    <select name="status" id="status" required>

                        <option value="scheduled"
                            {{ old('status', $flight->status) == 'scheduled' ? 'selected' : '' }}>
                            Programmé
                        </option>

                        <option value="in_progress"
                            {{ old('status', $flight->status) == 'in_progress' ? 'selected' : '' }}>
                            En cours
                        </option>

                        <option value="completed"
                            {{ old('status', $flight->status) == 'completed' ? 'selected' : '' }}>
                            Terminé
                        </option>

                        <option value="cancelled"
                            {{ old('status', $flight->status) == 'cancelled' ? 'selected' : '' }}>
                            Annulé
                        </option>

                    </select>

                    @error('status')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="buttons">

                <a href="{{ route('admin.flights.index') }}"
                   class="btn btn-cancel">
                    Annuler
                </a>

                <button type="submit" class="btn btn-submit">
                    Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>

</main>

</body>
</html>