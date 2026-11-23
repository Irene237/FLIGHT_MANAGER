<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestion des bagages | FLIGHT MANAGER</title>

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
            --green-bg: #dcfce7;
            --green: #15803d;
            --amber-bg: #fef3c7;
            --amber: #b45309;
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

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--surface);
            border: 1px solid var(--border-soft);
            border-radius: 14px;
            padding: 24px 28px;
            box-shadow: 0 2px 10px rgba(16, 42, 67, 0.03);
        }

        .card h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 20px;
        }

        /* ===== TWO-COLUMN GRID ===== */
        .baggage-grid {
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: 24px;
            align-items: start;
            margin-bottom: 24px;
        }

        /* LEFT CARD: FRANCHISE INCLUSE */
        .allowance-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #eef2f7;
            font-size: 13px;
        }

        .allowance-row:first-of-type {
            padding-top: 4px;
        }

        .allowance-row:last-of-type {
            border-bottom: none;
        }

        .allowance-label {
            font-weight: 700;
            color: var(--text-main);
        }

        .allowance-value {
            font-weight: 700;
            color: var(--blue);
        }

        .allowance-note {
            margin-top: 14px;
            font-size: 11.5px;
            color: var(--text-muted);
        }

        /* RIGHT CARD: AJOUTER UN BAGAGE EN SOUTE */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 18px;
            margin-bottom: 18px;
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
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
            background: #ffffff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24, 95, 168, 0.1);
        }

        .form-group input[readonly] {
            background: #fafbfd;
            color: var(--text-main);
        }

        .fee-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0 22px;
        }

        .fee-label {
            font-size: 12.5px;
            color: var(--text-muted);
        }

        .fee-amount {
            font-size: 17px;
            font-weight: 800;
            color: var(--text-main);
        }

        .submit-row {
            display: flex;
            justify-content: flex-end;
        }

        .btn-submit {
            min-width: 240px;
            height: 44px;
            padding: 0 24px;
            border: none;
            border-radius: 9px;
            background: var(--blue);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: var(--blue-hover);
        }

        /* BOTTOM CARD: RAPPEL IMPORTANT */
        .reminder-card h2 {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .reminder-card p {
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.55;
        }

        /* OPTIONAL REGISTERED BAGGAGES TABLE */
        .registered-card {
            margin-top: 24px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 620px;
        }

        th {
            text-align: left;
            font-size: 11px;
            color: var(--text-muted);
            padding: 10px 8px;
            border-bottom: 1px solid var(--border-soft);
        }

        td {
            padding: 14px 8px;
            font-size: 12.5px;
            border-bottom: 1px solid #f0f4f8;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .tag {
            font-weight: 700;
            color: var(--navy);
        }

        .badge {
            display: inline-block;
            padding: 4px 11px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-green {
            background: var(--green-bg);
            color: var(--green);
        }

        .badge-amber {
            background: var(--amber-bg);
            color: var(--amber);
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .baggage-grid {
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

            .btn-submit {
                width: 100%;
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
                <a href="{{ route('accueil') }}#recherche">Rechercher un vol</a>
                <a href="{{ route('dashboard') }}#reservations" class="active">Mes réservations</a>
                <a href="{{ route('dashboard') }}#voyages">Mes voyages</a>
            </nav>

            <a href="{{ route('dashboard') }}" class="account-pill">Mon compte</a>
        </div>
    </header>

    <main class="page-container">

        <!-- DECONNEXION -->
        <div class="logout-bar">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">↪ Déconnexion</button>
            </form>
        </div>

        <!-- TITRE -->
        <div class="page-heading">
            <h1>Gestion des bagages</h1>
            <p>Ajoutez vos bagages et vérifiez la franchise incluse dans votre billet.</p>
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <!-- DEUX COLONNES : FRANCHISE + FORMULAIRE -->
        <div class="baggage-grid">

            <!-- FRANCHISE INCLUSE -->
            <section class="card">
                <h2>Franchise incluse</h2>

                <div class="allowance-row">
                    <span class="allowance-label">Bagage cabine</span>
                    <span class="allowance-value">1 × 7 kg</span>
                </div>

                <div class="allowance-row">
                    <span class="allowance-label">Bagage en soute</span>
                    <span class="allowance-value">1 × 23 kg</span>
                </div>

                <p class="allowance-note">Votre billet inclut ces franchises.</p>
            </section>

            <!-- AJOUTER UN BAGAGE EN SOUTE -->
            <section class="card">
                <h2>Ajouter un bagage en soute</h2>

                <form action="{{ route('bagages.store') }}" method="POST" id="baggageForm">
                    @csrf

                    <div class="form-grid">
                        <!-- CHOIX DE LA RESERVATION -->
<div class="form-group">
    <label for="reservation_id">Réservation concernée</label>

    <select id="reservation_id" name="reservation_id" required>
        <option value="">Choisir une réservation</option>

        @foreach($reservations as $reservation)
            <option
                value="{{ $reservation->id }}"
                {{ old('reservation_id') == $reservation->id ? 'selected' : '' }}
            >
                {{ $reservation->reference }}
            </option>
        @endforeach
    </select>
</div>

<!-- CHOIX DU PASSAGER -->
<div class="form-group">
    <label for="reservation_passenger_id">Passager concerné</label>

    <select id="reservation_passenger_id" name="reservation_passenger_id" required>
        <option value="">Choisir un passager</option>

        @foreach($reservations as $reservation)
            @foreach($reservation->passengers as $passenger)
                <option
                    value="{{ $passenger->id }}"
                    data-reservation="{{ $reservation->id }}"
                    {{ old('reservation_passenger_id') == $passenger->id ? 'selected' : '' }}
                >
                    {{ $passenger->first_name }} {{ $passenger->last_name }}
                </option>
            @endforeach
        @endforeach
    </select>
</div>
                        <div class="form-group">
                            <label for="quantity">Nombre de bagages</label>
                            <input
                                type="number"
                                id="quantity"
                                name="quantity"
                                value="{{ old('quantity', 1) }}"
                                min="1"
                                max="10"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label for="unit_weight_display">Poids par bagage</label>
                            <input
                                type="text"
                                id="unit_weight_display"
                                value="23 kg"
                                readonly
                            >
                            <input type="hidden" id="weight" name="weight" value="23">
                        </div>

                        <div class="form-group">
                            <label for="type">Type de bagage</label>
                            <select id="type" name="type">
                                <option value="supplementaire" {{ old('type') === 'supplementaire' ? 'selected' : '' }}>Bagage supplémentaire</option>
                                <option value="soute" {{ old('type') === 'soute' ? 'selected' : '' }}>Bagage en soute standard</option>
                                <option value="special" {{ old('type') === 'special' ? 'selected' : '' }}>Équipement spécial</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="total_weight_display">Poids total</label>
                            <input
                                type="text"
                                id="total_weight_display"
                                value="23 kg"
                                readonly
                            >
                        </div>
                    </div>

                    <div class="fee-summary">
                        <span class="fee-label">Frais supplémentaires estimés</span>
                        <span class="fee-amount" id="estimatedFee">0 FCFA</span>
                    </div>

                    <div class="submit-row">
                        <button type="submit" class="btn-submit">
                            Enregistrer mes bagages
                        </button>
                    </div>
                </form>
            </section>

        </div>

        <!-- RAPPEL IMPORTANT -->
        <section class="card reminder-card">
            <h2>Rappel important</h2>
            <p>
                Les dimensions et poids autorisés dépendent des règles du transporteur. Les frais affichés sont indicatifs dans cette démonstration.
            </p>
        </section>

        <!-- LISTE DES BAGAGES ENREGISTRES (si présents en base) -->
        @if(isset($baggages) && $baggages->count() > 0)
            <section class="card registered-card">
                <h2>Mes bagages enregistrés</h2>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Numéro de bagage</th>
                                <th>Réservation</th>
                                <th>Passager</th>
                                <th>Type</th>
                                <th>Poids</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($baggages as $baggage)
                                <tr>
                                    <td class="tag">{{ $baggage->tag_number }}</td>
                                    <td>{{ $baggage->reservation->reference ?? 'Non disponible' }}</td>
                                    <td>
                                        @if($baggage->passenger)
                                            {{ $baggage->passenger->first_name }} {{ $baggage->passenger->last_name }}
                                        @else
                                            Non renseigné
                                        @endif
                                    </td>
                                    <td>{{ ucfirst($baggage->type) }}</td>
                                    <td>{{ number_format((float) $baggage->weight, 2, ',', ' ') }} kg</td>
                                    <td>
                                        @php $status = strtolower($baggage->status); @endphp
                                        <span class="badge {{ in_array($status, ['registered', 'checked', 'delivered']) ? 'badge-green' : 'badge-amber' }}">
                                            @switch($status)
                                                @case('registered') Enregistré @break
                                                @case('checked') En soute @break
                                                @case('delivered') Livré @break
                                                @case('lost') Perdu @break
                                                @default {{ ucfirst($baggage->status) }}
                                            @endswitch
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        @endif

    </main>

    <script>
const reservationSelect = document.getElementById('reservation_id');
const passengerSelect = document.getElementById('reservation_passenger_id');

function filterPassengers() {
    const reservationId = reservationSelect.value;

    Array.from(passengerSelect.options).forEach(option => {
        if (option.value === '') {
            option.hidden = false;
            return;
        }

        option.hidden = option.dataset.reservation !== reservationId;
    });

    const selectedOption = passengerSelect.selectedOptions[0];

    if (selectedOption && selectedOption.hidden) {
        passengerSelect.value = '';
    }
}

reservationSelect.addEventListener('change', filterPassengers);

filterPassengers();

        const quantityInput = document.getElementById('quantity');
        const typeSelect = document.getElementById('type');
        const unitWeightDisplay = document.getElementById('unit_weight_display');
        const weightHidden = document.getElementById('weight');
        const totalWeightDisplay = document.getElementById('total_weight_display');
        const estimatedFee = document.getElementById('estimatedFee');

        function updateBaggageSummary() {
            const qty = Math.max(1, parseInt(quantityInput.value, 10) || 1);
            let unitWeight = 23;
            let extraBags = Math.max(0, qty - 1);
            let feePerExtra = 25000;

            if (typeSelect.value === 'special') {
                unitWeight = 32;
                feePerExtra = 35000;
            }

           const totalWeight = qty * unitWeight;
            const totalFee = extraBags * feePerExtra;

            unitWeightDisplay.value = unitWeight + ' kg';
            weightHidden.value = totalWeight;
            totalWeightDisplay.value = totalWeight + ' kg';
            estimatedFee.textContent = totalFee.toLocaleString('fr-FR') + ' FCFA';
        }

        quantityInput.addEventListener('input', updateBaggageSummary);
        typeSelect.addEventListener('change', updateBaggageSummary);
        updateBaggageSummary();
    </script>

</body>
</html>