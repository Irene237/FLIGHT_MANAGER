<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --navy: #0c233c;
            --blue: #2563eb;
            --blue-light: #eff6ff;
            --background: #f5f7fb;
            --white: #ffffff;
            --text: #172b4d;
            --muted: #718096;
            --border: #e5eaf1;
            --red: #dc2626;
            --green: #16a34a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--background);
            color: var(--text);
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            background: var(--navy);
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 28px 18px;
            display: flex;
            flex-direction: column;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 45px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            background: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .brand-name {
            font-size: 15px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .menu-title {
            color: #8295aa;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.3px;
            padding: 0 12px;
            margin-bottom: 15px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 14px;
            border-radius: 9px;
            text-decoration: none;
            color: #b8c5d4;
            font-size: 13px;
            font-weight: 500;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: #1d4165;
            color: white;
        }

        .menu a.active {
            border-left: 3px solid #60a5fa;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 17px;
        }

        .sidebar-footer {
            margin-top: auto;
            border-top: 1px solid #294158;
            padding: 20px 10px 0;
            color: #8295aa;
            font-size: 11px;
            line-height: 1.7;
        }

        /* MAIN */
        .main {
            margin-left: 255px;
            width: calc(100% - 255px);
        }

        /* TOPBAR */
        .topbar {
            height: 75px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
        }

        .breadcrumb {
            font-size: 12px;
            color: var(--muted);
        }

        .breadcrumb span {
            color: var(--text);
            font-weight: 600;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 37px;
            height: 37px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 800;
        }

        .admin-info strong {
            display: block;
            font-size: 12px;
        }

        .admin-info small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            margin-top: 3px;
        }

        .logout {
            background: #fff1f2;
            color: var(--red);
            border: 1px solid #fecdd3;
            padding: 9px 13px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        /* CONTENT */
        .content {
            padding: 35px;
            max-width: 1200px;
            margin: auto;
        }

        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .page-heading h1 {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: var(--muted);
            font-size: 13px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            background: white;
            border: 1px solid var(--border);
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
        }

        /* FORM CARD */
        .form-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .03);
        }

        .card-header {
            padding: 22px 27px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .card-icon {
            width: 43px;
            height: 43px;
            background: var(--blue-light);
            color: var(--blue);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .card-header h2 {
            font-size: 15px;
            margin-bottom: 5px;
        }

        .card-header p {
            color: var(--muted);
            font-size: 11px;
        }

        .form-body {
            padding: 28px;
        }

        .form-section-title {
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 20px;
            color: #334155;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        label .required {
            color: var(--red);
        }

        .form-control {
            width: 100%;
            height: 45px;
            padding: 0 14px;
            border: 1px solid #dce3ed;
            border-radius: 8px;
            outline: none;
            font-family: inherit;
            font-size: 12px;
            color: var(--text);
            background: white;
            transition: .2s;
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .field-hint {
            font-size: 10px;
            color: var(--muted);
        }

        .error-message {
            color: var(--red);
            font-size: 11px;
        }

        .form-control.is-invalid {
            border-color: var(--red);
        }

        .info-box {
            margin-top: 25px;
            padding: 14px 16px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 9px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        .info-box span {
            font-size: 17px;
        }

        .info-box p {
            color: #1e40af;
            font-size: 11px;
            line-height: 1.7;
        }

        .form-footer {
            border-top: 1px solid var(--border);
            padding: 20px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            background: #fcfdff;
        }

        .btn {
            padding: 12px 19px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
        }

        .btn-cancel {
            color: #475569;
            background: white;
            border: 1px solid #dce3ed;
        }

        .btn-submit {
            color: white;
            background: var(--blue);
            box-shadow: 0 3px 8px rgba(37, 99, 235, .2);
        }

        .btn-submit:hover {
            background: #1d4ed8;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 13px 16px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 22px;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 75px;
                padding: 20px 10px;
            }

            .brand-name,
            .menu-title,
            .menu a .menu-text,
            .sidebar-footer {
                display: none;
            }

            .brand {
                justify-content: center;
                padding: 0;
            }

            .menu a {
                justify-content: center;
                padding: 13px 5px;
            }

            .main {
                margin-left: 75px;
                width: calc(100% - 75px);
            }

            .topbar {
                padding: 0 20px;
            }

            .content {
                padding: 25px 18px;
            }
        }

        @media(max-width: 600px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .page-heading {
                flex-direction: column;
                gap: 15px;
            }

            .admin-info {
                display: none;
            }

            .form-body {
                padding: 20px;
            }

            .form-footer {
                padding: 18px;
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">✈️</div>
            <div class="brand-name">FLIGHT MANAGER</div>
        </div>

        <div class="menu-title">MENU PRINCIPAL</div>

        <nav class="menu">

            <a href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">▦</span>
                <span class="menu-text">Tableau de bord</span>
            </a>

            <a href="{{ route('admin.flights.index') }}">
                <span class="menu-icon">✈</span>
                <span class="menu-text">Gestion des vols</span>
            </a>

            <a href="{{ route('admin.aircraft.index') }}">
                <span class="menu-icon">▣</span>
                <span class="menu-text">Avions</span>
            </a>

            <a href="{{ route('admin.reservations.index') }}">
                <span class="menu-icon">▤</span>
                <span class="menu-text">Réservations</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="active">
                <span class="menu-icon">♙</span>
                <span class="menu-text">Utilisateurs</span>
            </a>

            <a href="#">
                <span class="menu-icon">▧</span>
                <span class="menu-text">Gestion des bagages</span>
            </a>

            <a href="#">
                <span class="menu-icon">♧</span>
                <span class="menu-text">Gestion des équipages</span>
            </a>

            <a href="#">
                <span class="menu-icon">⚙</span>
                <span class="menu-text">Paramètres système</span>
            </a>

        </nav>

        <div class="sidebar-footer">
            FLIGHT MANAGER<br>
            Administration © 2026
        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div class="breadcrumb">
                Administration / Utilisateurs /
                <span>Ajouter un client</span>
            </div>

            <div class="topbar-right">

                <div class="admin-profile">
                    <div class="avatar">AD</div>

                    <div class="admin-info">
                        <strong>Administrateur</strong>
                        <small>Super administrateur</small>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout">
                        ↪ Déconnexion
                    </button>
                </form>

            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <div class="page-heading">

                <div>
                    <h1>Ajouter un client</h1>
                    <p>Créez un nouveau compte client sur la plateforme FLIGHT MANAGER.</p>
                </div>

                <a href="{{ route('admin.users.index') }}" class="back-link">
                    ← Retour à la liste
                </a>

            </div>


            <!-- FORM CARD -->
            <div class="form-card">

                <div class="card-header">

                    <div class="card-icon">♙</div>

                    <div>
                        <h2>Informations du client</h2>
                        <p>Renseignez les informations nécessaires à la création du compte.</p>
                    </div>

                </div>


                <form action="{{ route('admin.users.store') }}" method="POST">

                    @csrf

                    <div class="form-body">

                        @if ($errors->any())
                            <div class="alert-error">
                                <strong>Une erreur est survenue.</strong>
                                <ul style="margin: 8px 0 0 18px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h3 class="form-section-title">
                            INFORMATIONS PERSONNELLES
                        </h3>

                        <div class="form-grid">

                            <!-- NOM -->
                            <div class="form-group full">

                                <label for="name">
                                    Nom complet <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Ex : Irene Abeng"
                                    value="{{ old('name') }}"
                                    required
                                >

                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <!-- EMAIL -->
                            <div class="form-group">

                                <label for="email">
                                    Adresse e-mail <span class="required">*</span>
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="exemple@email.com"
                                    value="{{ old('email') }}"
                                    required
                                >

                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <!-- TELEPHONE -->
                            <div class="form-group">

                                <label for="phone">
                                    Numéro de téléphone
                                </label>

                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="+237 6XX XXX XXX"
                                    value="{{ old('phone') }}"
                                >

                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        <h3 class="form-section-title" style="margin-top: 32px;">
                            SÉCURITÉ DU COMPTE
                        </h3>

                        <div class="form-grid">

                            <!-- PASSWORD -->
                            <div class="form-group">

                                <label for="password">
                                    Mot de passe <span class="required">*</span>
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimum 8 caractères"
                                    required
                                >

                                <span class="field-hint">
                                    Le mot de passe doit contenir au moins 8 caractères.
                                </span>

                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror

                            </div>


                            <!-- CONFIRM PASSWORD -->
                            <div class="form-group">

                                <label for="password_confirmation">
                                    Confirmer le mot de passe <span class="required">*</span>
                                </label>

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Saisissez à nouveau le mot de passe"
                                    required
                                >

                            </div>

                        </div>


                        <div class="info-box">
                            <span>ℹ️</span>
                            <p>
                                <strong>Information :</strong>
                                Le compte créé depuis cette page possède automatiquement
                                le rôle <strong>Client</strong>. Il ne pourra pas accéder
                                à l'espace d'administration.
                            </p>
                        </div>

                    </div>


                    <!-- BUTTONS -->
                    <div class="form-footer">

                        <a href="{{ route('admin.users.index') }}" class="btn btn-cancel">
                            Annuler
                        </a>

                        <button type="submit" class="btn btn-submit">
                            + Créer le client
                        </button>

                    </div>

                </form>

            </div>

        </section>

    </main>

</div>

</body>
</html>