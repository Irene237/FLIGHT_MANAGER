<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rechercher un vol | FLIGHT MANAGER</title>

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
            --navy: #0f294a;
            --blue: #185fa8;
            --blue-hover: #124a84;
            --bg-page: #f5f7fa;
            --surface: #ffffff;
            --text-main: #102a43;
            --text-muted: #718296;
            --border-soft: #e6ecf3;
            --input-border: #dce4ee;
            --logout-red: #dc3545;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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

        /* ===== TOPBAR ===== */
        .topbar {
            height: 68px;
            background: var(--surface);
            border-bottom: 1px solid var(--border-soft);
            padding: 0 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: 0.3px;
            color: var(--navy);
            white-space: nowrap;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 26px;
        }

        .nav-links a {
            font-size: 13px;
            font-weight: 500;
            color: #52647a;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: var(--blue);
            font-weight: 700;
        }

        .account-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            border-radius: 999px;
            background: #eef4fb;
            color: var(--blue);
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ===== MAIN CONTAINER ===== */
        .page-container {
            max-width: 1120px;
            margin: 0 auto;
            padding: 24px 24px 50px;
        }

        .logout-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 6px;
            min-height: 24px;
        }

        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            border: none;
            color: var(--logout-red);
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 8px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background: #fff1f2;
        }

        .page-heading {
            margin-bottom: 24px;
        }

        .page-heading h1 {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .page-heading p {
            color: var(--text-muted);
            font-size: 13px;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 26px 28px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
            margin-bottom: 22px;
        }

        .card-heading {
            margin-bottom: 22px;
        }

        .card-heading h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 5px;
        }

        .card-heading p {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        /* ===== SEARCH FORM GRID ===== */
        .top-fields-grid {
            display: grid;
            grid-template-columns: 1.35fr 1.35fr 0.85fr 0.85fr;
            gap: 16px;
            margin-bottom: 18px;
        }

        .bottom-fields-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 16px;
            align-items: end;
        }

        .form-group label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 7px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 44px;
            border: 1px solid var(--input-border);
            border-radius: 9px;
            padding: 0 14px;
            background: #ffffff;
            color: var(--text-main);
            font-size: 13px;
            font-weight: 500;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input::placeholder {
            color: #9aa8b8;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24, 95, 168, 0.1);
        }

        .submit-col {
            grid-column: 4 / 5;
            display: flex;
            justify-content: flex-end;
        }

        .btn-search {
            width: 100%;
            min-width: 210px;
            height: 44px;
            border: none;
            border-radius: 9px;
            background: var(--blue);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-search:hover {
            background: var(--blue-hover);
        }

        /* ===== POPULAR DESTINATIONS ===== */
        .popular-card h2 {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 18px;
        }

        .destinations-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .destination-item {
            display: block;
            padding: 6px 4px;
            border-radius: 8px;
            transition: opacity 0.2s;
        }

        .destination-item:hover {
            opacity: 0.78;
        }

        .destination-item h3 {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .destination-item p {
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 960px) {
            .top-fields-grid {
                grid-template-columns: 1fr 1fr;
            }

            .bottom-fields-grid {
                grid-template-columns: 1fr 1fr;
            }

            .submit-col {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 720px) {
            .topbar {
                height: auto;
                padding: 12px 16px;
                flex-wrap: wrap;
                gap: 12px;
            }

            .nav-right {
                width: 100%;
                justify-content: space-between;
                gap: 12px;
            }

            .nav-links {
                gap: 14px;
                overflow-x: auto;
            }

            .page-container {
                padding: 18px 14px 36px;
            }

            .top-fields-grid,
            .bottom-fields-grid,
            .destinations-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- BARRE DE NAVIGATION -->
    <header class="topbar">
        <a href="{{ route('accueil') }}" class="brand">
            <span style="font-size: 22px;">✈️</span>
            <span>FLIGHT MANAGER</span>
        </a>

        <div class="nav-right">
            <nav class="nav-links" aria-label="Navigation principale">
                <a href="{{ route('accueil') }}">Accueil</a>
                <a href="{{ route('vols.recherche') }}" class="active">Rechercher un vol</a>
                <a href="{{ route('dashboard') }}#reservations">Mes réservations</a>
                <a href="{{ route('dashboard') }}#voyages">Mes voyages</a>
            </nav>

            @auth
                <a href="{{ route('dashboard') }}" class="account-pill">Mon compte</a>
            @else
                <a href="{{ route('connexion') }}" class="account-pill">Connexion</a>
            @endauth
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main class="page-container">

        <!-- DECONNEXION -->
        <div class="logout-bar">
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">↪ Déconnexion</button>
                </form>
            @endauth
        </div>

        <!-- TITRE -->
        <div class="page-heading">
            <h1>Rechercher un vol</h1>
            <p>Renseignez votre trajet et vos dates pour découvrir les vols disponibles.</p>
        </div>

        <!-- CARTE FORMULAIRE -->
        <section class="card">
            <div class="card-heading">
                <h2>Où souhaitez-vous aller ?</h2>
                <p>Choisissez votre trajet, vos dates et le nombre de voyageurs.</p>
            </div>

            <form action="{{ route('vols.resultats') }}" method="GET" id="searchForm">

                <!-- LIGNE 1 : DEPART / ARRIVEE / DATE DEPART / DATE RETOUR -->
                <div class="top-fields-grid">

                    <div class="form-group">
                        <label for="departure_airport_id">Ville de départ</label>
                        <select name="departure_airport_id" id="departure_airport_id" required>
                            <option value="">Sélectionnez une ville de départ</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}"
                                    {{ request('departure_airport_id') == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->city }} ({{ $airport->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="arrival_airport_id">Ville d'arrivée</label>
                        <select name="arrival_airport_id" id="arrival_airport_id" required>
                            <option value="">Sélectionnez une ville d'arrivée</option>
                            @foreach($airports as $airport)
                                <option value="{{ $airport->id }}"
                                    {{ request('arrival_airport_id') == $airport->id ? 'selected' : '' }}>
                                    {{ $airport->city }} ({{ $airport->code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="departure_date">Date de départ</label>
                        <input
                            type="date"
                            name="departure_date"
                            id="departure_date"
                            min="{{ date('Y-m-d') }}"
                            value="{{ request('departure_date', date('Y-m-d')) }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="return_date">Date de retour</label>
                        <input
                            type="text"
                            name="return_date"
                            id="return_date"
                            placeholder="Facultatif"
                            value="{{ request('return_date') }}"
                            onfocus="(this.type='date'); this.min=document.getElementById('departure_date').value || '{{ date('Y-m-d') }}';"
                            onblur="if(!this.value) this.type='text';"
                        >
                    </div>

                </div>

                <!-- LIGNE 2 : PASSAGERS / CLASSE / BOUTON -->
                <div class="bottom-fields-grid">

                    <div class="form-group">
                        <label for="passengers">Passagers</label>
                        <select name="passengers" id="passengers" required>
                            @for($i = 1; $i <= 9; $i++)
                                <option value="{{ $i }}" {{ request('passengers', 1) == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i > 1 ? 'adultes' : 'adulte' }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cabin_class">Classe</label>
                        <select name="cabin_class" id="cabin_class">
                            <option value="economique" {{ request('cabin_class', 'economique') === 'economique' ? 'selected' : '' }}>
                                Économique
                            </option>
                            <option value="affaires" {{ request('cabin_class') === 'affaires' ? 'selected' : '' }}>
                                Affaires
                            </option>
                            <option value="premiere" {{ request('cabin_class') === 'premiere' ? 'selected' : '' }}>
                                Première
                            </option>
                        </select>
                    </div>

                    <div class="submit-col">
                        <button type="submit" class="btn-search">
                            Rechercher les vols
                        </button>
                    </div>

                </div>

            </form>
        </section>

        <!-- DESTINATIONS POPULAIRES -->
        <section class="card popular-card">
            <h2>Destinations populaires</h2>

            <div class="destinations-grid">
                <a href="#searchForm" class="destination-item" data-from="Douala" data-to="Paris">
                    <h3>Paris</h3>
                    <p>Depuis Douala</p>
                </a>

                <a href="#searchForm" class="destination-item" data-from="Yaoundé" data-to="Dakar">
                    <h3>Dakar</h3>
                    <p>Depuis Yaoundé</p>
                </a>

                <a href="#searchForm" class="destination-item" data-from="Douala" data-to="Abidjan">
                    <h3>Abidjan</h3>
                    <p>Depuis Douala</p>
                </a>
            </div>
        </section>

    </main>

    <script>
        // Empêcher de choisir le même aéroport au départ et à l'arrivée.
        document.getElementById('searchForm').addEventListener('submit', function (event) {
            const departure = document.getElementById('departure_airport_id').value;
            const arrival = document.getElementById('arrival_airport_id').value;

            if (departure && arrival && departure === arrival) {
                event.preventDefault();
                alert('La ville de départ et la ville d’arrivée doivent être différentes.');
            }
        });

        // Pré-remplir le formulaire au clic sur une destination populaire.
        document.querySelectorAll('.destination-item').forEach(function (item) {
            item.addEventListener('click', function () {
                const fromCity = this.dataset.from.toLowerCase();
                const toCity = this.dataset.to.toLowerCase();
                const departureSelect = document.getElementById('departure_airport_id');
                const arrivalSelect = document.getElementById('arrival_airport_id');

                Array.from(departureSelect.options).forEach(function (opt) {
                    if (opt.text.toLowerCase().includes(fromCity)) {
                        departureSelect.value = opt.value;
                    }
                });

                Array.from(arrivalSelect.options).forEach(function (opt) {
                    if (opt.text.toLowerCase().includes(toCity)) {
                        arrivalSelect.value = opt.value;
                    }
                });
            });
        });
    </script>

</body>

</html>