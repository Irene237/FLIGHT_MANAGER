<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | FLIGHT MANAGER</title>

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
            --navy-dark: #0a233f;
            --navy-mid: #163a5f;
            --slate-wave: #5e6d7a;
            --blue-wave: #22496d;
            --sunset-orange: #e38e55;
            --sun-disc: #eab47b;
            --text-main: #0f2942;
            --text-muted: #6e7f91;
            --border-light: #dce4ee;
            --accent-blue: #1d5ca8;
            --bg-page: #eef2f7;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            background: var(--bg-page);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            color: var(--text-main);
        }

        .login-container {
            width: 100%;
            max-width: 1120px;
            min-height: 670px;
            display: grid;
            grid-template-columns: 45% 55%;
            background: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(10, 35, 63, 0.14);
        }

        /* ===== PARTIE GAUCHE (Illustration fidèle à la maquette) ===== */
        .welcome-panel {
            position: relative;
            background: linear-gradient(175deg, #162b44 0%, #594b4a 36%, #d98752 62%, #183654 100%);
            color: #ffffff;
            padding: 36px 38px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .art-layer {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            z-index: 0;
        }

        .panel-top {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.4px;
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
        }

        .logo-icon {
    font-size: 25px;
    display: inline-block;
    line-height: 1;
}

        .back-home-light {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 999px;
            background: rgba(10, 35, 63, 0.35);
            backdrop-filter: blur(4px);
            transition: background 0.2s;
        }

        .back-home-light:hover {
            background: rgba(10, 35, 63, 0.6);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            margin-top: auto;
            padding-bottom: 18px;
        }

        .kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.92);
            margin-bottom: 10px;
            text-shadow: 0 1px 8px rgba(0, 0, 0, 0.25);
        }

        .welcome-content h1 {
            font-size: 44px;
            font-weight: 800;
            line-height: 1.06;
            letter-spacing: -0.8px;
            color: #ffffff;
            margin-bottom: 16px;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.25);
        }

        .welcome-content p {
            font-size: 14px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.92);
            max-width: 340px;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.25);
        }

        .welcome-footer {
            position: relative;
            z-index: 2;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.4px;
            color: rgba(255, 255, 255, 0.8);
            text-transform: uppercase;
        }

        /* ===== PARTIE DROITE (Formulaire) ===== */
        .form-panel {
            padding: 52px 64px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .form-badge {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--accent-blue);
            margin-bottom: 10px;
        }

        .form-panel h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .form-group input {
            width: 100%;
            height: 50px;
            border: 1.5px solid var(--border-light);
            border-radius: 10px;
            padding: 0 16px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text-main);
            background: #fbfcfe;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-group input::placeholder {
            color: #9aa8b8;
        }

        .form-group input:focus {
            background: #ffffff;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(29, 92, 168, 0.12);
        }

        .password-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 6px 0 26px;
            font-size: 13px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .remember {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
            font-weight: 500;
        }

        .remember input {
            width: 15px;
            height: 15px;
            accent-color: var(--navy-dark);
            cursor: pointer;
        }

        .forgot {
            color: var(--accent-blue);
            text-decoration: none;
            font-weight: 600;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #0d2744 0%, #174676 100%);
            color: #ffffff;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.15s, filter 0.2s;
            box-shadow: 0 8px 20px rgba(13, 39, 68, 0.22);
        }

        .login-button:hover {
            filter: brightness(1.08);
        }

        .login-button:active {
            transform: scale(0.99);
        }

        .register-text {
            text-align: center;
            margin-top: 26px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .register-text a {
            color: var(--accent-blue);
            font-weight: 700;
            text-decoration: none;
        }

        .register-text a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .status-message {
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        @media (max-width: 920px) {
            body {
                padding: 14px;
            }

            .login-container {
                grid-template-columns: 1fr;
                max-width: 480px;
                min-height: auto;
            }

            .welcome-panel {
                min-height: 360px;
                padding: 26px 26px 28px;
            }

            .welcome-content h1 {
                font-size: 34px;
            }

            .form-panel {
                padding: 36px 26px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- PARTIE GAUCHE -->
    <section class="welcome-panel">

        <!-- Scène graphique vectorielle fidèle à la maquette -->
        <svg class="art-layer" viewBox="0 0 500 720" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
                <linearGradient id="skyGrad" x1="0%" y1="0%" x2="100%" y2="55%">
                    <stop offset="0%" stop-color="#132942" />
                    <stop offset="52%" stop-color="#6e5750" />
                    <stop offset="100%" stop-color="#e39258" />
                </linearGradient>
                <linearGradient id="sunGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#f7c888" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="#e69b5c" stop-opacity="0.72" />
                </linearGradient>
                <linearGradient id="waveGrey" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#4e5c6b" />
                    <stop offset="100%" stop-color="#768390" />
                </linearGradient>
                <linearGradient id="waveBlue" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#193957" />
                    <stop offset="100%" stop-color="#2c567c" />
                </linearGradient>
                <linearGradient id="deepSea" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#12314e" />
                    <stop offset="100%" stop-color="#091f36" />
                </linearGradient>
                <linearGradient id="stoneGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#dce4ec" stop-opacity="0.92" />
                    <stop offset="100%" stop-color="#8fa3b8" stop-opacity="0.82" />
                </linearGradient>
            </defs>

            <!-- Ciel dégradé -->
            <rect width="500" height="720" fill="url(#skyGrad)" />

            <!-- Étoiles subtiles -->
            <circle cx="88" cy="128" r="1.8" fill="#ffffff" opacity="0.65" />
            <circle cx="388" cy="68" r="1.6" fill="#ffffff" opacity="0.55" />
            <circle cx="435" cy="142" r="1.4" fill="#ffffff" opacity="0.5" />

            <!-- Disque solaire -->
            <circle cx="362" cy="186" r="88" fill="url(#sunGrad)" />

            <!-- Avion stylisé blanc -->
            <g transform="translate(142, 232) rotate(-11)">
                <!-- Fuselage -->
                <path d="M0 16 L195 -6 L258 -12 C268 -13 274 -8 272 -2 C270 4 261 7 250 9 L196 15 L14 34 C4 35 -4 24 0 16 Z" fill="#f7f9fc" />
                <!-- Dérive / queue -->
                <path d="M58 14 L24 -36 L54 -39 L94 10 Z" fill="#e6eef7" />
                <!-- Stabilisateur horizontal arrière -->
                <path d="M36 16 L12 4 L28 2 L54 14 Z" fill="#cfdbe8" />
                <!-- Aile principale -->
                <path d="M128 16 L196 -26 L220 -24 L164 18 Z" fill="#eef3f8" />
                <path d="M118 22 L166 56 L186 54 L144 20 Z" fill="#d5e0ec" />
            </g>

            <!-- Vagues superposées -->
            <path d="M0 340 Q140 295 270 265 T500 225 L500 430 L0 430 Z" fill="url(#waveGrey)" />
            <path d="M0 392 Q165 348 310 315 T500 285 L500 500 L0 500 Z" fill="url(#waveBlue)" />
            <path d="M0 445 Q180 415 340 385 T500 365 L500 720 L0 720 Z" fill="url(#deepSea)" />

            <!-- Galets / formes organiques en bas -->
            <ellipse cx="145" cy="522" rx="115" ry="44" fill="url(#stoneGrad)" />
            <ellipse cx="365" cy="528" rx="118" ry="42" fill="url(#stoneGrad)" opacity="0.88" />
            <ellipse cx="220" cy="585" rx="145" ry="52" fill="url(#stoneGrad)" />
        </svg>

        <div class="panel-top">
            <a href="{{ route('accueil') }}" class="logo">
    <span class="logo-icon">✈️</span>
    <span>FLIGHT MANAGER</span>
</a>
          <a href="{{ route('accueil') }}" class="back-home-light">
    ← Retour à l'accueil
</a>
        </div>

        <div class="welcome-content">
            <div class="kicker">Votre voyage commence ici</div>
            <h1>Bienvenue<br>à bord !</h1>
            <p>
                Connectez-vous et préparez votre prochain voyage en toute simplicité.
            </p>
        </div>

        <div class="welcome-footer">
            2026 FLIGHT MANAGER TOUS DROITS RÉSERVÉS
        </div>

    </section>

    <!-- PARTIE DROITE -->
    <section class="form-panel">

        <div class="form-badge">Votre espace voyageur</div>
        <h2>Connexion</h2>
        <p class="subtitle">
            Accédez à votre compte FLIGHT MANAGER
        </p>

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

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="exemple@email.com"
                    autocomplete="email"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Saisissez votre mot de passe"
                    autocomplete="current-password"
                    required
                >
            </div>

            <div class="password-options">
                <label class="remember">
                    <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    Se souvenir de moi
                </label>

                <a href="#" class="forgot">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="login-button">
                Se connecter
            </button>
        </form>

        <p class="register-text">
            Vous n'avez pas encore de compte ?
            <a href="{{ url('/inscription') }}">Créer un compte</a>
        </p>

    </section>

</div>

</body>
</html>