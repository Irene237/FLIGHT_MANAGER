<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration | FLIGHT MANAGER</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --navy: #0a233f;
            --blue: #174676;
            --accent: #e38e55;
            --text: #0f2942;
            --muted: #718096;
            --border: #dce4ee;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #eef2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            color: var(--text);
        }

        .container {
            width: 100%;
            max-width: 1120px;
            min-height: 670px;
            display: grid;
            grid-template-columns: 45% 55%;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(10, 35, 63, 0.14);
        }

        /* PANNEAU GAUCHE */

        .welcome-panel {
            position: relative;
            overflow: hidden;
            padding: 38px;
            color: white;
            background:
                radial-gradient(circle at 80% 25%, rgba(227,142,85,.8), transparent 25%),
                linear-gradient(150deg, #0a233f, #174676 60%, #091f36);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .welcome-panel::before {
            content: "✈";
            position: absolute;
            font-size: 270px;
            right: -55px;
            top: 160px;
            color: rgba(255,255,255,.07);
            transform: rotate(-15deg);
        }

        .top {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .logo {
            color: white;
            text-decoration: none;
            font-weight: 800;
            font-size: 17px;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .logo-icon {
            font-size: 26px;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-size: 12px;
            padding: 9px 13px;
            background: rgba(255,255,255,.12);
            border-radius: 20px;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .badge {
            display: inline-block;
            padding: 8px 13px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 22px;
            background: rgba(255,255,255,.08);
        }

        .welcome-content h1 {
            font-size: 43px;
            line-height: 1.1;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .welcome-content p {
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255,255,255,.8);
            max-width: 350px;
        }

        .welcome-footer {
            position: relative;
            z-index: 2;
            font-size: 10px;
            letter-spacing: 1px;
            color: rgba(255,255,255,.65);
        }

        /* FORMULAIRE */

        .form-panel {
            padding: 55px 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-badge {
            color: #c47742;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 13px;
        }

        h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 9px;
        }

        .subtitle {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .security-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f1f6fb;
            border: 1px solid #dce8f4;
            padding: 13px;
            border-radius: 10px;
            font-size: 12px;
            color: #315575;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            height: 51px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 0 15px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            background: #fbfcfe;
        }

        .form-group input:focus {
            border-color: var(--blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(29,92,168,.1);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 75px;
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--blue);
            font-weight: 700;
            cursor: pointer;
            font-size: 11px;
        }

        .login-button {
            width: 100%;
            height: 53px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #0d2744, #174676);
            color: white;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(13,39,68,.2);
            transition: .2s;
        }

        .login-button:hover {
            filter: brightness(1.12);
            transform: translateY(-1px);
        }

        .error-message {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 12px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .status-message {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 12px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .bottom-text {
            margin-top: 27px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .bottom-text a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 700;
        }

        @media(max-width: 850px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .welcome-panel {
                min-height: 320px;
                padding: 27px;
            }

            .welcome-content h1 {
                font-size: 34px;
            }

            .form-panel {
                padding: 35px 27px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- PANNEAU GAUCHE -->

    <section class="welcome-panel">

        <div class="top">

            <a href="{{ route('accueil') }}" class="logo">
                <span class="logo-icon">✈️</span>
                <span>FLIGHT MANAGER</span>
            </a>

            <a href="{{ route('accueil') }}" class="back-link">
                ← Accueil
            </a>

        </div>

        <div class="welcome-content">

            <div class="badge">
                ESPACE ADMINISTRATION
            </div>

            <h1>
                Pilotez<br>
                votre plateforme.
            </h1>

            <p>
                Bienvenue dans l'espace de gestion FLIGHT MANAGER.
                Connectez-vous pour administrer les opérations
                et superviser les activités de la plateforme.
            </p>

        </div>

        <div class="welcome-footer">
            FLIGHT MANAGER — ADMINISTRATION © 2026
        </div>

    </section>


    <!-- FORMULAIRE -->

    <section class="form-panel">

        <div class="form-badge">
            ACCÈS SÉCURISÉ
        </div>

        <h2>Connexion admin</h2>

        <p class="subtitle">
            Connectez-vous avec vos identifiants administrateur
            pour accéder au tableau de bord.
        </p>

        <div class="security-info">
            🔒
            <span>
                Cet espace est exclusivement réservé
                aux administrateurs autorisés.
            </span>
        </div>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">

            @csrf

            <div class="form-group">

                <label for="email">Adresse e-mail administrateur</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@flightmanager.com"
                    autocomplete="username"
                    required
                >

            </div>

            <div class="form-group">

                <label for="password">Mot de passe</label>

                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Votre mot de passe"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword()"
                        id="toggleButton"
                    >
                        Afficher
                    </button>

                </div>

            </div>

            <button type="submit" class="login-button">
                Accéder à l'administration →
            </button>

        </form>

        <div class="bottom-text">
            Accès réservé au personnel autorisé.
            <br><br>
            <a href="{{ route('accueil') }}">Retourner au site client</a>
        </div>

    </section>

</div>

<script>
    function togglePassword() {

        const password = document.getElementById('password');
        const button = document.getElementById('toggleButton');

        if (password.type === 'password') {
            password.type = 'text';
            button.textContent = 'Masquer';
        } else {
            password.type = 'password';
            button.textContent = 'Afficher';
        }
    }
</script>

</body>
</html>