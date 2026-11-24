<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation et informations des passagers | FLIGHT MANAGER</title>

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

        .error-box {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .error-box ul {
            margin-top: 6px;
            padding-left: 18px;
        }

        /* ===== TWO-COLUMN LAYOUT ===== */
        .booking-layout {
            display: grid;
            grid-template-columns: 0.78fr 1.22fr;
            gap: 24px;
            align-items: start;
        }

        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 24px 26px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        /* LEFT CARD: VOTRE VOL SELECTIONNE */
        .selected-flight-card h2 {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 14px;
        }

        .selected-route {
            font-size: 15px;
            font-weight: 800;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .selected-meta {
            font-size: 12px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .selected-price {
            font-size: 13px;
            font-weight: 700;
            color: var(--blue);
        }

        .seats-selector {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #eef2f7;
        }

        .seats-selector label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .seats-selector select {
            width: 100%;
            height: 40px;
            border: 1px solid var(--input-border);
            border-radius: 8px;
            padding: 0 12px;
            font-size: 12.5px;
            color: var(--text-main);
            background: #ffffff;
            outline: none;
        }

        /* RIGHT CARD: INFORMATIONS DES PASSAGERS */
        .passenger-block {
            margin-bottom: 24px;
        }

        .passenger-block:last-child {
            margin-bottom: 0;
        }

        .passenger-block h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 18px;
        }

        .form-group label {
            display: block;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            height: 42px;
            border: 1px solid var(--input-border);
            border-radius: 9px;
            padding: 0 14px;
            font-size: 13px;
            color: var(--text-main);
            background: #ffffff;
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

        .doc-note {
            margin-top: 14px;
            font-size: 11px;
            color: var(--text-muted);
        }

        .submit-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 22px;
        }

        .btn-continue {
            min-width: 225px;
            height: 42px;
            padding: 0 22px;
            border: none;
            border-radius: 8px;
            background: var(--blue);
            color: #ffffff;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-continue:hover {
            background: var(--blue-hover);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .booking-layout {
                grid-template-columns: 1fr;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .btn-continue {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    @php
        $depDate = \Carbon\Carbon::parse($flight->departure_at)->locale('fr')->translatedFormat('d F Y');
        $depTime = \Carbon\Carbon::parse($flight->departure_at)->format('H:i');
        $fullNameParts = preg_split('/\s+/', trim(optional(auth()->user())->name ?? 'Abeng Irene'), 2);
        $defaultLastName = old('passengers.0.last_name', $fullNameParts[0] ?? 'Abeng');
        $defaultFirstName = old('passengers.0.first_name', $fullNameParts[1] ?? 'Irene');
        $defaultEmail = old('passengers.0.email', optional(auth()->user())->email ?? '');
        $defaultPhone = old('passengers.0.phone', optional(auth()->user())->phone ?? '');
    @endphp

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
            <h1>Réservation et informations des passagers</h1>
            <p>Vérifiez le vol choisi puis renseignez les informations de chaque voyageur.</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <strong>Veuillez corriger les erreurs suivantes :</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reservations.store', $flight->id) }}" method="POST" id="bookingForm">
            @csrf

            <div class="booking-layout">

                <!-- COLONNE GAUCHE : VOL SELECTIONNE -->
                <aside class="card selected-flight-card">
                    <h2>Votre vol sélectionné</h2>

                    <div class="selected-route">
                        {{ $flight->departureAirport->city }} ({{ $flight->departureAirport->code }})
                        →
                        {{ $flight->arrivalAirport->city }} ({{ $flight->arrivalAirport->code }})
                    </div>

                    <div class="selected-meta">
                        {{ $depDate }} • {{ $depTime }}
                    </div>

                    <div class="selected-price">
                        {{ number_format($flight->price, 0, ',', ' ') }} FCFA / passager
                    </div>

                    <div class="seats-selector">
                        <label for="number_of_seats">Nombre de passagers</label>
                        <select name="number_of_seats" id="number_of_seats">
                            @for ($i = 1; $i <= min(9, max(1, (int) $flight->available_seats)); $i++)
                                <option value="{{ $i }}" {{ old('number_of_seats', request('passengers', 1)) == $i ? 'selected' : '' }}>
                                    {{ $i }} {{ $i > 1 ? 'passagers' : 'passager' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </aside>

                <!-- COLONNE DROITE : INFORMATIONS PASSAGERS -->
                <section class="card">
                    <div id="passengers-container"></div>

                    <p class="doc-note">
                        Les informations doivent correspondre aux documents de voyage.
                    </p>

                    <div class="submit-row">
                        <button type="submit" class="btn-continue">
                            Continuer vers les bagages
                        </button>
                    </div>
                </section>

            </div>
        </form>

    </main>

    <script>
        const passengerSelect = document.getElementById('number_of_seats');
        const passengersContainer = document.getElementById('passengers-container');

        const initialPassenger1 = {
            last_name: @json($defaultLastName),
            first_name: @json($defaultFirstName),
            date_of_birth: @json(old('passengers.0.date_of_birth', '')),
            nationality: @json(old('passengers.0.nationality', 'Camerounaise')),
            email: @json($defaultEmail),
            phone: @json($defaultPhone),
            document_type: @json(old('passengers.0.document_type', 'Passeport')),
            passport_number: @json(old('passengers.0.passport_number', ''))
        };

        function escapeAttr(str) {
            return String(str ?? '')
                .replace(/&/g, '&amp;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function renderPassengers() {
            const count = Math.max(1, parseInt(passengerSelect.value, 10) || 1);
            passengersContainer.innerHTML = '';

            for (let i = 0; i < count; i++) {
                const isFirst = i === 0;
                const data = isFirst ? initialPassenger1 : {
                    last_name: '',
                    first_name: '',
                    date_of_birth: '',
                    nationality: 'Camerounaise',
                    email: '',
                    phone: '',
                    document_type: 'Passeport',
                    passport_number: ''
                };

                const block = document.createElement('div');
                block.className = 'passenger-block';

                block.innerHTML = `
                    <h2>Informations du passager ${i + 1}</h2>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="p_${i}_last_name">Nom</label>
                            <input
                                type="text"
                                id="p_${i}_last_name"
                                name="passengers[${i}][last_name]"
                                value="${escapeAttr(data.last_name)}"
                                placeholder="Nom"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_first_name">Prénom</label>
                            <input
                                type="text"
                                id="p_${i}_first_name"
                                name="passengers[${i}][first_name]"
                                value="${escapeAttr(data.first_name)}"
                                placeholder="Prénom"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_dob">Date de naissance</label>
                            <input
                                type="text"
                                id="p_${i}_dob"
                                name="passengers[${i}][date_of_birth]"
                                value="${escapeAttr(data.date_of_birth)}"
                                placeholder="JJ/MM/AAAA"
                                onfocus="(this.type='date')"
                                onblur="if(!this.value) this.type='text';"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_nationality">Nationalité</label>
                            <input
                                type="text"
                                id="p_${i}_nationality"
                                name="passengers[${i}][nationality]"
                                value="${escapeAttr(data.nationality)}"
                                placeholder="Camerounaise"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_email">E-mail</label>
                            <input
                                type="email"
                                id="p_${i}_email"
                                name="passengers[${i}][email]"
                                value="${escapeAttr(data.email)}"
                                placeholder="exemple@email.com"
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_phone">Téléphone</label>
                            <input
                                type="tel"
                                id="p_${i}_phone"
                                name="passengers[${i}][phone]"
                                value="${escapeAttr(data.phone)}"
                                placeholder="+237 6XX XX XX XX"
                            >
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_doc_type">Type de document</label>
                            <select id="p_${i}_doc_type" name="passengers[${i}][document_type]">
                                <option value="Passeport" ${data.document_type === 'Passeport' ? 'selected' : ''}>Passeport</option>
                                <option value="CNI" ${data.document_type === 'CNI' ? 'selected' : ''}>Carte nationale d'identité</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="p_${i}_passport">Numéro du document</label>
                            <input
                                type="text"
                                id="p_${i}_passport"
                                name="passengers[${i}][passport_number]"
                                value="${escapeAttr(data.passport_number)}"
                                placeholder="Saisir le numéro"
                                required
                            >
                        </div>
                    </div>
                `;

                passengersContainer.appendChild(block);
            }
        }

        passengerSelect.addEventListener('change', renderPassengers);
        renderPassengers();
    </script>

</body>
</html>