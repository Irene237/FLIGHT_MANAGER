<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inscription | FLIGHT MANAGER</title>

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
            --text-main: #0f2942;
            --text-muted: #7b8c9e;
            --border-light: #dce4ee;
            --accent-blue: #1d6fa5;
            --bg-outer: #f2f5f9;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg-outer);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 20px;
            color: var(--text-main);
        }

        .container {
            width: 100%;
            max-width: 1120px;
            min-height: 700px;
            background: #ffffff;
            border-radius: 26px;
            padding: 18px;
            display: grid;
            grid-template-columns: 42% 58%;
            gap: 28px;
            box-shadow: 0 18px 50px rgba(10, 35, 63, 0.1);
        }

        /* PARTIE GAUCHE */
        .left-panel {
            position: relative;
            border-radius: 20px;
            color: #ffffff;
            padding: 32px 30px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            background: linear-gradient(175deg, #162b44 0%, #594b4a 36%, #d98752 62%, #183654 100%);
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
            gap: 10px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            text-decoration: none;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }

        .back-home-pill {
            font-size: 11px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 5px 11px;
            border-radius: 999px;
            background: rgba(10, 35, 63, 0.35);
            transition: background 0.2s;
        }

        .back-home-pill:hover {
            background: rgba(10, 35, 63, 0.6);
        }

        .left-text {
            position: relative;
            z-index: 2;
            margin-top: auto;
        }

        .kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.92);
            margin-bottom: 10px;
            text-shadow: 0 1px 8px rgba(0, 0, 0, 0.25);
        }

        .left-text h1 {
            font-size: 40px;
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -0.7px;
            margin-bottom: 14px;
            color: #ffffff;
            text-shadow: 0 2px 14px rgba(0, 0, 0, 0.25);
        }

        .left-text p {
            font-size: 13.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.92);
            max-width: 340px;
            text-shadow: 0 1px 10px rgba(0, 0, 0, 0.25);
        }

        /* PARTIE DROITE */
        .right-panel {
            padding: 24px 36px 24px 14px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-kicker {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.3px;
            text-transform: uppercase;
            color: var(--accent-blue);
            margin-bottom: 6px;
        }

        .form-header {
            margin-bottom: 20px;
        }

        .form-header h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .form-header p {
            color: var(--text-muted);
            font-size: 13.5px;
        }

        .form-group {
            margin-bottom: 13px;
        }

        .form-group label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            margin-bottom: 6px;
            color: var(--text-main);
        }

        .form-group input {
            width: 100%;
            height: 44px;
            border: 1.5px solid var(--border-light);
            border-radius: 10px;
            padding: 0 14px;
            font-family: inherit;
            font-size: 13.5px;
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
            box-shadow: 0 0 0 3px rgba(29, 111, 165, 0.12);
        }

        .terms {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 14px 0 16px;
            font-size: 12px;
            color: #6b7d90;
            line-height: 1.5;
        }

        .terms input[type="checkbox"] {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            border: 1.5px solid #cbd5e1;
            accent-color: var(--navy-dark);
            cursor: pointer;
        }

        .terms label {
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 10px;
            background: var(--navy-dark);
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
        }

        .submit-btn:hover {
            background: #133b66;
        }

        .submit-btn:active {
            transform: scale(0.99);
        }

        .login-link {
            text-align: center;
            margin-top: 16px;
            font-size: 12.5px;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--accent-blue);
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc3545;
            font-size: 11.5px;
            margin-top: 4px;
        }

        .alert {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            color: #be123c;
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 12px;
            margin-bottom: 14px;
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 520px;
                padding: 14px;
                gap: 20px;
            }

            .left-panel {
                min-height: 340px;
                padding: 24px;
            }

            .left-text h1 {
                font-size: 32px;
            }

            .right-panel {
                padding: 12px 14px 18px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 12px;
            }

            .form-header h2 {
                font-size: 26px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- PARTIE GAUCHE -->
    <section class="left-panel">

        <svg class="art-layer" viewBox="0 0 500 740" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
                <linearGradient id="regSkyGrad" x1="0%" y1="0%" x2="100%" y2="55%">
                    <stop offset="0%" stop-color="#132942" />
                    <stop offset="52%" stop-color="#6e5750" />
                    <stop offset="100%" stop-color="#e39258" />
                </linearGradient>
                <linearGradient id="regSunGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#f7c888" stop-opacity="0.95" />
                    <stop offset="100%" stop-color="#e69b5c" stop-opacity="0.72" />
                </linearGradient>
                <linearGradient id="regWaveGrey" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#4e5c6b" />
                    <stop offset="100%" stop-color="#768390" />
                </linearGradient>
                <linearGradient id="regWaveBlue" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" stop-color="#193957" />
                    <stop offset="100%" stop-color="#2c567c" />
                </linearGradient>
                <linearGradient id="regDeepSea" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#12314e" />
                    <stop offset="100%" stop-color="#091f36" />
                </linearGradient>
                <linearGradient id="regStoneGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop offset="0%" stop-color="#dce4ec" stop-opacity="0.92" />
                    <stop offset="100%" stop-color="#8fa3b8" stop-opacity="0.82" />
                </linearGradient>
            </defs>

            <rect width="500" height="740" fill="url(#regSkyGrad)" />

            <circle cx="88" cy="132" r="1.8" fill="#ffffff" opacity="0.65" />
            <circle cx="388" cy="70" r="1.6" fill="#ffffff" opacity="0.55" />
            <circle cx="435" cy="146" r="1.4" fill="#ffffff" opacity="0.5" />

            <circle cx="362" cy="190" r="88" fill="url(#regSunGrad)" />

            <g transform="translate(142, 238) rotate(-11)">
                <path d="M0 16 L195 -6 L258 -12 C268 -13 274 -8 272 -2 C270 4 261 7 250 9 L196 15 L14 34 C4 35 -4 24 0 16 Z" fill="#f7f9fc" />
                <path d="M58 14 L24 -36 L54 -39 L94 10 Z" fill="#e6eef7" />
                <path d="M36 16 L12 4 L28 2 L54 14 Z" fill="#cfdbe8" />
                <path d="M128 16 L196 -26 L220 -24 L164 18 Z" fill="#eef3f8" />
                <path d="M118 22 L166 56 L186 54 L144 20 Z" fill="#d5e0ec" />
            </g>

            <path d="M0 348 Q140 302 270 272 T500 232 L500 440 L0 440 Z" fill="url(#regWaveGrey)" />
            <path d="M0 402 Q165 356 310 322 T500 292 L500 510 L0 510 Z" fill="url(#regWaveBlue)" />
            <path d="M0 456 Q180 425 340 395 T500 375 L500 740 L0 740 Z" fill="url(#regDeepSea)" />

            <ellipse cx="145" cy="534" rx="115" ry="44" fill="url(#regStoneGrad)" />
            <ellipse cx="365" cy="540" rx="118" ry="42" fill="url(#regStoneGrad)" opacity="0.88" />
            <ellipse cx="220" cy="598" rx="145" ry="52" fill="url(#regStoneGrad)" />
        </svg>

        <div class="panel-top">
            <a href="{{ route('accueil') }}" class="logo">
    <span style="font-size: 24px;">✈️</span>
    <span>FLIGHT MANAGER</span>
</a>
            <a href="{{ route('accueil') }}" class="back-home-pill">← Accueil</a>
        </div>

        <div class="left-text">
            <div class="kicker">Rejoignez notre communauté</div>
            <h1>Le monde<br>vous attend.</h1>
            <p>
                Créez votre compte et découvrez une nouvelle façon de préparer vos voyages en toute simplicité.
            </p>
        </div>

    </section>

    <!-- PARTIE DROITE -->
    <section class="right-panel">

        <div class="form-kicker">Créez votre espace voyageur</div>

        <div class="form-header">
            <h2>Créer un compte</h2>
            <p>Inscrivez-vous pour réserver et suivre vos vols.</p>
        </div>

        @if ($errors->any())
            <div class="alert">
                Veuillez corriger les erreurs du formulaire.
            </div>
        @endif

        <form action="{{ route('inscription.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nom complet</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Votre nom et prénom"
                    value="{{ old('name') }}"
                    required
                >
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="exemple@email.com"
                    value="{{ old('email') }}"
                    required
                >
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Téléphone</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="+237 6XX XXX XXX"
                    value="{{ old('phone') }}"
                    required
                >
                @error('phone')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Créez un mot de passe sécurisé"
                    required
                >
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Saisissez à nouveau le mot de passe"
                    required
                >
            </div>

            <div class="terms">
                <input
                    type="checkbox"
                    id="terms"
                    name="terms"
                    value="1"
                    {{ old('terms') ? 'checked' : '' }}
                    required
                >
                <label for="terms">
                    J'accepte les conditions d'utilisation et la politique de confidentialité.
                </label>
            </div>

            @error('terms')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-btn">
                Créer mon compte
            </button>
        </form>

        <div class="login-link">
            Vous avez déjà un compte ?
            <a href="{{ route('connexion') }}">Se connecter</a>
        </div>

    </section>

</div>

</body>
</html>