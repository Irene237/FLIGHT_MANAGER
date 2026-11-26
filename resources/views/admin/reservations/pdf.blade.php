<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Rapport des réservations - FLIGHT MANAGER</title>

    <style>
        @page {
            margin: 25px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #263445;
        }

        .header {
            background-color: #10243e;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            color: #cbd8e8;
            font-size: 10px;
            margin-top: 5px;
        }

        .report-info {
            text-align: right;
            font-size: 9px;
            color: #dce7f5;
        }

        .section-title {
            font-size: 15px;
            font-weight: bold;
            color: #10243e;
            margin: 20px 0 10px;
        }

        .summary {
            width: 100%;
            margin-bottom: 20px;
        }

        .summary td {
            background-color: #eef4fa;
            padding: 12px;
            border: 1px solid #dce5ef;
            text-align: center;
        }

        .summary-label {
            font-size: 9px;
            color: #64748b;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #10243e;
            margin-top: 5px;
        }

        table.reservations {
            width: 100%;
            border-collapse: collapse;
        }

        table.reservations thead {
            background-color: #10243e;
            color: white;
        }

        table.reservations th {
            padding: 9px 6px;
            font-size: 8px;
            text-align: left;
        }

        table.reservations td {
            padding: 9px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8px;
        }

        table.reservations tr:nth-child(even) {
            background-color: #f5f8fc;
        }

        .reference {
            font-weight: bold;
            color: #1769aa;
        }

        .status {
            font-weight: bold;
        }

        .confirmed {
            color: #15803d;
        }

        .pending {
            color: #d97706;
        }

        .cancelled {
            color: #dc2626;
        }

        .other {
            color: #475569;
        }

        .amount {
            font-weight: bold;
            white-space: nowrap;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #64748b;
            background-color: #f8fafc;
        }

        .footer {
            margin-top: 25px;
            padding-top: 10px;
            border-top: 1px solid #dce5ef;
            font-size: 8px;
            color: #64748b;
        }

        .footer-left {
            text-align: left;
        }

        .footer-right {
            text-align: right;
        }
    </style>
</head>

<body>

    {{-- EN-TÊTE --}}
    <div class="header">
        <table width="100%">
            <tr>
                <td width="65%">
                    <div class="brand">✈ FLIGHT MANAGER</div>
                    <div class="subtitle">
                        Système de gestion des réservations aériennes
                    </div>
                </td>

                <td width="35%" class="report-info">
                    <strong>RAPPORT ADMINISTRATIF</strong><br>
                    Date d'édition : {{ now()->format('d/m/Y à H:i') }}<br>
                    Document officiel
                </td>
            </tr>
        </table>
    </div>


    {{-- TITRE --}}
    <div class="section-title">
        Rapport des réservations
    </div>


    {{-- STATISTIQUES --}}
    <table class="summary">
        <tr>
            <td width="33%">
                <div class="summary-label">TOTAL DES RÉSERVATIONS</div>
                <div class="summary-value">
                    {{ $reservations->count() }}
                </div>
            </td>

            <td width="33%">
                <div class="summary-label">RÉSERVATIONS CONFIRMÉES</div>
                <div class="summary-value">
                    {{ $reservations->where('status', 'confirmed')->count() }}
                </div>
            </td>

            <td width="34%">
                <div class="summary-label">RÉSERVATIONS EN ATTENTE</div>
                <div class="summary-value">
                    {{ $reservations->where('status', 'pending')->count() }}
                </div>
            </td>
        </tr>
    </table>


    {{-- TABLEAU DES RÉSERVATIONS --}}
    <table class="reservations">

        <thead>
            <tr>
                <th>RÉFÉRENCE</th>
                <th>CLIENT</th>
                <th>PASSAGER</th>
                <th>VOL</th>
                <th>TRAJET</th>
                <th>DATE DU VOL</th>
                <th>PLACES</th>
                <th>MONTANT</th>
                <th>STATUT</th>
            </tr>
        </thead>

        <tbody>

            @forelse($reservations as $reservation)

                @php
                    $passenger = $reservation->passengers->first();

                    $statusClass = match($reservation->status) {
                        'confirmed' => 'confirmed',
                        'pending' => 'pending',
                        'cancelled' => 'cancelled',
                        default => 'other',
                    };

                    $statusLabel = match($reservation->status) {
                        'confirmed' => 'Confirmée',
                        'pending' => 'En attente',
                        'cancelled' => 'Annulée',
                        default => ucfirst($reservation->status),
                    };
                @endphp

                <tr>
                    <td class="reference">
                        {{ $reservation->reference }}
                    </td>

                    <td>
                        {{ $reservation->user?->name ?? 'Non renseigné' }}
                    </td>

                    <td>
                        @if($passenger)
                            {{ $passenger->first_name }}
                            {{ $passenger->last_name }}
                        @else
                            Non renseigné
                        @endif
                    </td>

                    <td>
                        {{ $reservation->flight?->flight_number ?? 'N/A' }}
                    </td>

                    <td>
                        {{ $reservation->flight?->departureAirport?->code ?? 'N/A' }}
                        →
                        {{ $reservation->flight?->arrivalAirport?->code ?? 'N/A' }}
                    </td>

                    <td>
                        @if($reservation->flight?->departure_at)
                            {{ $reservation->flight->departure_at->format('d/m/Y H:i') }}
                        @else
                            N/A
                        @endif
                    </td>

                    <td>
                        {{ $reservation->number_of_seats }}
                    </td>

                    <td class="amount">
                        {{ number_format((float) $reservation->total_amount, 0, ',', ' ') }}
                        FCFA
                    </td>

                    <td class="status {{ $statusClass }}">
                        {{ $statusLabel }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="9" class="empty">
                        Aucune réservation trouvée pour les critères sélectionnés.
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>


    {{-- PIED DE PAGE --}}
    <div class="footer">
        <table width="100%">
            <tr>
                <td class="footer-left">
                    FLIGHT MANAGER — Gestion des réservations
                </td>

                <td class="footer-right">
                    Total : {{ $reservations->count() }} réservation(s)
                </td>
            </tr>
        </table>
    </div>

</body>
</html>