<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CKL Fleet Management System (FMS) — logistics backend. Project case study by Najla Putri Afifah.">
    <title>Fleet Management System · Najla Putri Afifah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f1ec;
            --bg-2: #ebe6df;
            --surface: #ffffff;
            --text: #121212;
            --muted: #5a5650;
            --line: rgba(18, 18, 18, 0.08);
            --line-strong: rgba(18, 18, 18, 0.14);
            --accent: #1a1a1a;
            --highlight: #c45c26;
            --radius-lg: 28px;
            --radius: 18px;
            --shadow: 0 28px 80px rgba(18, 14, 10, 0.08);
            --font-display: "Syne", system-ui, sans-serif;
            --font-body: "DM Sans", system-ui, sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }
        .grain {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: 0.35;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            mix-blend-mode: multiply;
        }
        .container {
            width: min(1180px, 92%);
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }
        .header {
            position: sticky;
            top: 0;
            z-index: 40;
            background: rgba(244, 241, 236, 0.92);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
        }
        .nav {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .brand {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: -0.03em;
            color: var(--text);
            text-decoration: none;
        }
        .brand:hover { color: var(--highlight); }
        .back-link {
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--muted);
            text-decoration: none;
            border-bottom: 2px solid transparent;
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        .back-link:hover {
            color: var(--text);
            border-color: var(--text);
        }
        .project-hero {
            padding: clamp(48px, 8vh, 80px) 0 clamp(32px, 5vh, 48px);
        }
        .project-label {
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 12px;
        }
        .project-title {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(2.25rem, 5vw, 3.5rem);
            letter-spacing: -0.025em;
            line-height: 1.12;
            margin-bottom: 16px;
            max-width: 18ch;
        }
        .project-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 24px;
        }
        .pill {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--line-strong);
            background: var(--surface);
            font-size: 0.8125rem;
            font-weight: 600;
            color: #3d3d3d;
        }
        .pill--dark {
            background: var(--accent);
            color: #f4f1ec;
            border-color: var(--accent);
        }
        .project-lead {
            font-size: clamp(1.0625rem, 2vw, 1.2rem);
            color: var(--muted);
            max-width: 68ch;
            margin-bottom: 32px;
        }
        .project-visual {
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--line);
            background: linear-gradient(145deg, #0c2340 0%, #153d6b 42%, #1e5a96 100%);
            padding: clamp(28px, 4vw, 48px);
            box-shadow: var(--shadow);
            margin-bottom: clamp(40px, 6vh, 64px);
        }
        .project-visual img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 14px;
            box-shadow: 0 28px 70px rgba(0, 0, 0, 0.4);
        }
        .project-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 0.85fr);
            gap: clamp(28px, 4vw, 48px);
            padding-bottom: clamp(56px, 10vh, 96px);
        }
        .project-section h2 {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 14px;
            letter-spacing: -0.02em;
        }
        .project-section p,
        .project-section li {
            color: var(--muted);
            font-size: 0.9875rem;
            line-height: 1.7;
        }
        .project-section p + p { margin-top: 14px; }
        .project-section ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .project-section li::before {
            content: "—";
            color: var(--highlight);
            margin-right: 10px;
            font-weight: 700;
        }
        .project-aside {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .info-card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 22px 24px;
            background: var(--surface);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
        }
        .info-card dt {
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 6px;
        }
        .info-card dd {
            font-size: 0.9375rem;
            color: var(--text);
            font-weight: 600;
        }
        .info-card dd + dt { margin-top: 16px; }
        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .skill-tags span {
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: var(--surface);
            font-size: 0.8125rem;
            font-weight: 600;
            color: #3d3d3d;
        }
        .project-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 16px;
            margin-bottom: 32px;
        }
        .project-actions a {
            display: inline-flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 999px;
            padding: 12px 22px;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }
        .project-actions a:hover { transform: translateY(-2px); }
        .btn-live {
            background: var(--accent);
            color: #f4f1ec;
            box-shadow: 0 8px 28px rgba(18, 18, 18, 0.15);
        }
        .btn-live:hover { box-shadow: 0 12px 36px rgba(18, 18, 18, 0.22); }
        @media (max-width: 860px) {
            .project-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="grain" aria-hidden="true"></div>

    <header class="header">
        <div class="container nav">
            <a class="brand" href="{{ url('/#home') }}">Najla.</a>
            <a class="back-link" href="{{ url('/#proyek') }}">← Back to projects</a>
        </div>
    </header>

    <main class="container">
        <section class="project-hero">
            <p class="project-label">CKL · Logistics platform</p>
            <h1 class="project-title">Fleet Management System</h1>
            <div class="project-meta">
                <span class="pill pill--dark">Backend Developer</span>
                <span class="pill">CKL Indonesia Raya Tower</span>
                <span class="pill">Fleet operations</span>
            </div>
            <p class="project-lead">FMS is a logistics backend that registers trucks and drivers, plans delivery trips with routes and checkpoints, runs quality checks, lets drivers execute trips from a mobile app, and gives operations tools to monitor status and fix problems along the way.</p>
            <div class="project-actions">
                <a class="btn-live" href="https://sandbox.fleet.cklcargo.com/login" rel="noopener noreferrer" target="_blank">Visit website →</a>
            </div>
        </section>

        <div class="project-visual">
            <img
                src="{{ asset('images/projects/fms-showcase.png') }}"
                alt="CKL Fleet Management System — platform screens"
                width="1200"
                height="800"
                loading="eager"
                decoding="async"
            >
        </div>

        <div class="project-grid">
            <div class="project-section">
                <h2>Overview</h2>
                <p>FMS supports CKL Cargo fleet operations—from registering trucks and drivers to planning trips with routes, checkpoints, and quality checks before drivers execute deliveries via the mobile app.</p>
                <p>As Backend Developer, I build server-side logic, APIs, and data layers that power trip planning, fleet monitoring, and operational tools for resolving issues along the route.</p>

                <h2 style="margin-top: 32px;">Key contributions</h2>
                <ul>
                    <li>Backend APIs for fleet, driver, and vehicle registration</li>
                    <li>Trip planning with routes, checkpoints, and quality-check workflows</li>
                    <li>Operations dashboards for monitoring trip status and resolving issues</li>
                    <li>Integration between web operations tools and driver mobile app execution</li>
                </ul>
            </div>

            <aside class="project-aside">
                <dl class="info-card">
                    <dt>Role</dt>
                    <dd>Backend Developer</dd>
                    <dt>Company</dt>
                    <dd>CKL Indonesia Raya Tower</dd>
                    <dt>Industry</dt>
                    <dd>Logistics &amp; cargo</dd>
                    <dt>Period</dt>
                    <dd>Aug 2025 – Present</dd>
                </dl>
                <div class="info-card">
                    <dt style="margin-bottom: 12px;">Tech stack</dt>
                    <div class="skill-tags">
                        <span>Backend</span>
                        <span>PHP</span>
                        <span>APIs</span>
                        <span>SQL</span>
                        <span>Logistics</span>
                    </div>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>
