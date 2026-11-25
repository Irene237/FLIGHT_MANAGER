<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Carte d'embarquement | FLIGHT MANAGER</title>

    <style>
        @page {
            margin: 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #102a43;
            font-size: 11px;
        }

        .header {
            background: #0e243e;
            color: white;
            padding: 22px;
        }

        .brand {
            font-size: 19px;
            font-weight: bold;
        }

        .subtitle {
            color: #dbeafe;
            font-size: 10px;
            margin-top: 6px;
        }

        .content {
            border: 1px solid #e6ecf3;
            padding: 22px;
        }

        .title {
            text-align: center;
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .status {
            text-align: center;
            color: #15803d;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .section-title {
            color: #185fa8;
            font-weight: bold;
            font-size: 11px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            padding: 10px 6px;
            border-bottom: 1px solid #e6ecf3;
        }

        .label {
            color: #718296;
            width: 40%;
        }

        .value {
            font-weight: bold;
            color: #102a43;
        }

        .route {
            margin-top: 25px;
            padding: 18px;
            background: #eff6ff;
        }

        .route td {
            text-align: center;
            width: 45%;
        }

        .route .arrow {
            width: 10%;
            color: #185fa8;
            font-size: 20px;
        }

        .airport-code {
            font-size: 25px;
            font-weight: bold;
            color: #0e243e;
        }

        .airport-city {
            color: #718296;
            margin-top: 6px;
        }

        .qr-section {
            text-align: center;
            margin-top: 25px;
            padding-top: 18px;
            border-top: 1px dashed #d5deea;
        }

        .qr-section svg {
            width: 135px;
            height: 135px;
        }

        .qr-caption {
            color: #185fa8;
            font-weight: bold;
            margin-top: 8px;
        }

        .reference {
            color: #718296;
            margin-top: 7px;
            font-size: 10px;
        }

        .footer {
            margin-top: 20px;
            padding: 14px;
            background: #f8fafc;
            text-align: center;
            color: #718296;
            font-size: 9px;
        }
    </style>
</head>

<body>

@php
    $flight = $checkIn->flight;
    $passenger = $checkIn->passenger;
    $departure = $flight->departureAirport;
    $arrival = $flight->arrivalAirport;

    $departureDate = \Carbon\Carbon::parse($flight->departure_at)
        ->locale('fr')
        ->translatedFormat('d F Y');

    $departureTime = \Carbon\Carbon::parse($flight->departure_at)
        ->format('H:i');

    $arrivalTime = \Carbon\Carbon::parse($flight->arrival_at)
        ->format('H:i');

    $checkedInAt = \Carbon\Carbon::parse($checkIn->checked_in_at)
        ->format('d/m/Y à H:i');
@endphp

<div class="header">
    <div class="brand">✈ FLIGHT MANAGER</div>
    <div class="subtitle">Votre voyage commence ici</div>
</div>

<div class="content">

    <div class="title">CARTE D'EMBARQUEMENT</div>

    <div class="status">
        ✓ ENREGISTREMENT CONFIRMÉ
    </div>

    <div class="section-title">
        INFORMATIONS DU PASSAGER
    </div>

    <table class="details">
        <tr>
            <td class="label">Nom complet</td>
            <td class="value">
                {{ $passenger->first_name }}
                {{ $passenger->last_name }}
            </td>
        </tr>

        <tr>
            <td class="label">Référence réservation</td>
            <td class="value">
                {{ $checkIn->reservation->reference }}
            </td>
        </tr>

        <tr>
            <td class="label">Référence enregistrement</td>
            <td class="value">
                {{ $checkIn->checkin_reference }}
            </td>
        </tr>

        <tr>
            <td class="label">Siège attribué</td>
            <td class="value">
                {{ $checkIn->seat_number }}
            </td>
        </tr>

        <tr>
            <td class="label">Date d'enregistrement</td>
            <td class="value">
                {{ $checkedInAt }}
            </td>
        </tr>
    </table>

    <div class="section-title">
        INFORMATIONS DU VOL
    </div>

    <table class="details">
        <tr>
            <td class="label">Numéro du vol</td>
            <td class="value">{{ $flight->flight_number }}</td>
        </tr>

        <tr>
            <td class="label">Date de départ</td>
            <td class="value">{{ $departureDate }}</td>
        </tr>

        <tr>
            <td class="label">Heure de départ</td>
            <td class="value">{{ $departureTime }}</td>
        </tr>

        <tr>
            <td class="label">Heure d'arrivée</td>
            <td class="value">{{ $arrivalTime }}</td>
        </tr>

        <tr>
            <td class="label">Avion</td>
            <td class="value">
                {{ $flight->aircraft?->model ?? 'Non renseigné' }}
            </td>
        </tr>
    </table>

    <div class="route">
        <table>
            <tr>
                <td>
                    <div class="airport-code">
                        {{ $departure->code }}
                    </div>

                    <div class="airport-city">
                        {{ $departure->city }}
                    </div>
                </td>

                <td class="arrow">✈</td>

                <td>
                    <div class="airport-code">
                        {{ $arrival->code }}
                    </div>

                    <div class="airport-city">
                        {{ $arrival->city }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="qr-section">

        <div class="section-title">
            CODE DE VÉRIFICATION
        </div>

        {!! $qrCode !!}

        <div class="qr-caption">
            Présentez ce code lors de votre embarquement.
        </div>

        <div class="reference">
            Référence : {{ $checkIn->checkin_reference }}
        </div>

    </div>

</div>

<div class="footer">
    FLIGHT MANAGER — Carte d'embarquement générée électroniquement.
    <br>
    Merci d'avoir choisi notre compagnie.
</div>

</body>
</html>