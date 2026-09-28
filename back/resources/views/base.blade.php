<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titre', 'Administration') · Culture Quiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;900&family=Rajdhani:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Même charte graphique que l'application React (front/src/index.css). */
        :root {
            color-scheme: dark;
            --bg: #05060b;
            --panel: #12141f;
            --border: rgba(255, 232, 31, 0.22);
            --border-soft: rgba(255, 255, 255, 0.08);
            --accent: #ffe81f;
            --accent-dim: #cbb400;
            --good: #35e07a;
            --bad: #ff4d4d;
            --text: #f4f5f7;
            --text-dim: #9aa0b4;
            --font-display: 'Orbitron', 'Segoe UI', sans-serif;
            --font-body: 'Rajdhani', 'Segoe UI', sans-serif;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100dvh;
            background: var(--bg);
            background-image: radial-gradient(ellipse 80% 50% at 50% -10%, rgba(255, 232, 31, 0.08), transparent);
            color: var(--text);
            font-family: var(--font-body);
            font-size: 17px;
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2 {
            font-family: var(--font-display);
            letter-spacing: 0.04em;
            margin: 0 0 1.25rem;
        }

        h1 { font-size: clamp(1.4rem, 5vw, 2rem); }

        a { color: var(--accent); }

        .topbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem 1.5rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border-soft);
            background: rgba(10, 12, 20, 0.8);
        }

        .brand {
            font-family: var(--font-display);
            font-weight: 900;
            letter-spacing: 0.12em;
            text-decoration: none;
            color: var(--text);
        }

        .brand span { color: var(--accent); }

        .brand em {
            font-style: normal;
            font-size: 0.7rem;
            letter-spacing: 0.3em;
            color: var(--text-dim);
        }

        .topbar nav {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .topbar nav a {
            font-family: var(--font-display);
            font-size: 0.78rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            text-decoration: none;
            color: var(--text-dim);
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
        }

        .topbar nav a:hover { color: var(--accent); }

        .topbar nav a.is-active {
            color: var(--accent);
            border-bottom-color: var(--accent);
        }

        .deconnexion {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .deconnexion span {
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        .deconnexion button {
            background: none;
            border: 1px solid var(--border-soft);
            color: var(--text-dim);
            font-family: var(--font-display);
            font-size: 0.7rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.4rem 0.7rem;
            border-radius: 8px;
            cursor: pointer;
        }

        .deconnexion button:hover {
            color: var(--accent);
            border-color: var(--border);
        }

        .page {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 1.75rem 1.25rem 3rem;
        }

        .flash {
            border: 1px solid rgba(53, 224, 122, 0.4);
            background: rgba(53, 224, 122, 0.12);
            color: var(--good);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin: 0 0 1.5rem;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 1.25rem;
        }

        .liste {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .liste li {
            background: var(--panel);
            border: 1px solid var(--border-soft);
            border-radius: 10px;
            padding: 0.85rem 1rem;
        }

        .liste .meta {
            display: block;
            font-size: 0.85rem;
            color: var(--text-dim);
        }

        .liste .bonne { color: var(--good); }

        .champ {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            margin-bottom: 1rem;
        }

        .champ label {
            font-family: var(--font-display);
            font-size: 0.75rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent-dim);
        }

        .champ input,
        .champ select {
            width: 100%;
            min-height: 46px;
            padding: 0.55rem 0.75rem;
            border-radius: 10px;
            border: 1px solid var(--border-soft);
            background: #0b0d16;
            color: var(--text);
            font-family: var(--font-body);
            font-size: 1rem;
        }

        .champ input:focus,
        .champ select:focus {
            outline: 2px solid var(--accent);
            outline-offset: 1px;
        }

        .erreur {
            color: var(--bad);
            font-size: 0.85rem;
        }

        .btn {
            appearance: none;
            border: 1px solid var(--border);
            background: var(--accent);
            color: #0a0a0a;
            font-family: var(--font-display);
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            border-radius: 10px;
            padding: 0.8rem 1.5rem;
            min-height: 48px;
            cursor: pointer;
        }

        .btn:hover { box-shadow: 0 0 22px rgba(255, 232, 31, 0.35); }

        .vide { color: var(--text-dim); }
    </style>
</head>
<body>
    <header class="topbar">
        <a class="brand" href="{{ route('home') }}">CULTURE<span>QUIZ</span> <em>admin</em></a>
        @auth
            <nav>
                <a href="{{ route('listecategories') }}" class="{{ request()->routeIs('listecategories') ? 'is-active' : '' }}">Catégories</a>
                <a href="{{ route('createcategorie') }}" class="{{ request()->routeIs('createcategorie') ? 'is-active' : '' }}">+ Catégorie</a>
                <a href="{{ route('listequestions') }}" class="{{ request()->routeIs('listequestions') ? 'is-active' : '' }}">Questions</a>
                <a href="{{ route('createquestion') }}" class="{{ request()->routeIs('createquestion') ? 'is-active' : '' }}">+ Question</a>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="deconnexion">
                @csrf
                <span>{{ auth()->user()->name }}</span>
                <button type="submit">Déconnexion</button>
            </form>
        @endauth
    </header>

    <main class="page">
        @if (session('status'))
            <p class="flash">{{ session('status') }}</p>
        @endif

        @yield('content')
    </main>
</body>
</html>
