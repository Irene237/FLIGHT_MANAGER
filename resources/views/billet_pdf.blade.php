<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Billet électronique - {{ $reservation->reference }}</title>

    <style>
        @page {
            margin: 35px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #102a43;
            background: #f3f6fa;
            font-size: 12px;
        }

        .header {
            background: #102a43;
            color: white;
            padding: 22px;
            border-radius: 8px;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 10px;
            margin-top: 6px;
            color: #dbeafe;
        }

        .status {
            margin-top: 20px;
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
            border-radius: 6px;
            text-align: center;
            font-weight: bold;
        }

        .section {
            background: white;
            border: 1px solid #dce4ee;
            border-radius: 8px;
            padding: 18px;
            margin-top: 18px;
        }

        .section-title {
            color: #1761a0;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .route {
            text-align: center;
            padding: 20px 10px;
            background: #eef6fc;
            border-radius: 8px;
        }

        .city {
            font-size: 21px;
            font-weight: bold;
            color: #102a43;
        }

        .airport {
            color: #718296;
            font-size: 11px;
        }

        .arrow {
            color: #0284c7;
            font-size: 22px;
            padding: 0 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 5px;
            border-bottom: 1px solid #e6ecf3;
        }

        td:first-child {
            color: #718296;
            width: 42%;
        }

        td:last-child {
            font-weight: bold;
        }

        .reference {
            color: #1761a0;
            font-size: 17px;
            font-weight: bold;
        }

        .total {
            color: #1761a0;
            font-size: 16px;
        }

        .qr-section {
            text-align: center;
            margin-top: 22px;
            padding: 15px;
            background: #eef6fc;
            border-radius: 8px;
        }

        .qr-section svg {
            width: 125px;
            height: 125px;
        }

        .qr-label {
            margin-top: 8px;
            font-size: 10px;
            color: #718296;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            color: #718296;
            font-size: 9px;
            margin-top: 25px;
            border-top: 1px solid #dce4ee;
            padding-top: 12px;
        }
    </style>
</head>

<body>

@php
    $departure = $flight->departureAirport;
    $arrival = $flight->arrivalAirport;

    $departureDate = \Carbon\Carbon::parse($flight->departure_at)
        ->locale('fr')
        ->translatedFormat('d F Y');

    $departureTime = \Carbon\Carbon::parse($flight->departure_at)->format('H:i');
    $arrivalTime = \Carbon\Carbon::parse($flight->arrival_at)->format('H:i');

    $paymentLabels = [
        'mtn_mobile_money' => 'MTN Mobile Money',
        'orange_money' => 'Orange Money',
        'bank_card' => 'Carte bancaire',
    ];
@endphp

<div class="header">
    <div class="brand">✈ FLIGHT MANAGER</div>
    <div class="subtitle">BILLET ÉLECTRONIQUE DE TRANSPORT AÉRIEN</div>
</div>

<div class="status">
    ✓ PAIEMENT CONFIRMÉ — RÉSERVATION VALIDÉE
</div>

<div class="section">
    <div class="section-title">ITINÉRAIRE DU VOL</div>

    <div class="route">
        <span class="city">{{ $departure->city }}</span>
        <span class="arrow">→</span>
        <span class="city">{{ $arrival->city }}</span>

        <br>

        <span class="airport">{{ $departure->code }}</span>
        <span style="padding: 0 30px;"></span>
        <span class="airport">{{ $arrival->code }}</span>
    </div>

    <table style="margin-top: 15px;">
        <tr>
            <td>Numéro de vol</td>
            <td>{{ $flight->flight_number }}</td>
        </tr>
        <tr>
            <td>Date du départ</td>
            <td>{{ $departureDate }}</td>
        </tr>
        <tr>
            <td>Heure de départ</td>
            <td>{{ $departureTime }}</td>
        </tr>
        <tr>
            <td>Heure d'arrivée</td>
            <td>{{ $arrivalTime }}</td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">INFORMATIONS DE RÉSERVATION</div>

    <table>
        <tr>
            <td>Référence de réservation</td>
            <td class="reference">{{ $reservation->reference }}</td>
        </tr>
        <tr>
            <td>Nombre de places</td>
            <td>{{ $reservation->number_of_seats }}</td>
        </tr>
        <tr>
            <td>Nombre de passagers enregistrés</td>
            <td>{{ $reservation->passengers->count() }}</td>
        </tr>
        <tr>
            <td>Montant payé</td>
            <td class="total">
                {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
            </td>
        </tr>
        <tr>
            <td>Moyen de paiement</td>
            <td>{{ $paymentLabels[$payment->payment_method] ?? $payment->payment_method }}</td>
        </tr>
        <tr>
            <td>Référence de transaction</td>
            <td>{{ $payment->transaction_reference }}</td>
        </tr>
        <tr>
            <td>Date du paiement</td>
            <td>
                {{ $payment->paid_at
                    ? $payment->paid_at->locale('fr')->translatedFormat('d F Y à H:i')
                    : 'Non disponible' }}
            </td>
        </tr>
    </table>
</div>

<div class="section">
    <div class="section-title">LISTE DES PASSAGERS</div>

    <table>
        @foreach($reservation->passengers as $index => $passenger)
            <tr>
                <td>Passager {{ $index + 1 }}</td>
                <td>
                    {{ $passenger->first_name }} {{ $passenger->last_name }}
                </td>
            </tr>
        @endforeach
    </table>
</div>

<div class="qr-section">
    {!! $qrCode !!}

    <div class="qr-label">
        CODE QR DE VÉRIFICATION DU BILLET
    </div>

    <p>
        Présentez ce billet lors des contrôles d'embarquement.
    </p>
</div>

<div class="footer">
    FLIGHT MANAGER — Billet généré automatiquement à partir de votre réservation.<br>
    Paiement simulé dans le cadre de la démonstration académique.
</div>

</body>
</html>