<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portfolio Najla Putri Afifah — Software Engineering Technology, IPB University Vocational School.">
    <title>Portfolio | Najla Putri Afifah</title>
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
            --accent-soft: #3d3d3d;
            --highlight: #c45c26;
            --radius-lg: 28px;
            --radius: 18px;
            --shadow: 0 28px 80px rgba(18, 14, 10, 0.08);
            --shadow-hover: 0 36px 100px rgba(18, 14, 10, 0.12);
            --font-display: "Syne", system-ui, sans-serif;
            --font-body: "DM Sans", system-ui, sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            overflow-x: hidden;
            font-optical-sizing: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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

        /* —— Header —— */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 40;
            transition: background 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
        }
        .header.scrolled {
            background: rgba(244, 241, 236, 0.88);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--line);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.04);
        }

        .nav {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
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

        .nav-links {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 8px 20px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            transition: color 0.2s ease;
        }
        .nav-links a:hover { color: var(--text); }

        .nav-toggle {
            display: none;
            font-family: var(--font-body);
            font-size: 0.8125rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid var(--line-strong);
            background: var(--surface);
            cursor: pointer;
        }

        /* —— Hero —— */
        #home { scroll-margin-top: 88px; }
        #tentang, #pengalaman-profesional, #proyek, #sertifikasi, #kontak { scroll-margin-top: 96px; }

        .experience-stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
            max-width: 820px;
            position: relative;
            padding-left: 32px;
        }
        .experience-stack::before {
            content: "";
            position: absolute;
            left: 9px;
            top: 20px;
            bottom: 20px;
            width: 2px;
            background: linear-gradient(180deg, var(--highlight) 0%, var(--line-strong) 100%);
            border-radius: 2px;
        }
        .experience-stack .card {
            position: relative;
        }
        .experience-stack .card::before {
            content: "";
            position: absolute;
            left: -28px;
            top: 26px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--surface);
            border: 2px solid var(--highlight);
            box-shadow: 0 0 0 4px var(--bg);
        }

        .career-intro {
            margin-bottom: clamp(36px, 5vw, 52px);
        }
        .career-intro__head {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 20px 32px;
            align-items: end;
            margin-bottom: 22px;
        }
        .career-intro__head .section-title {
            margin-bottom: 0;
        }
        .career-intro__dot {
            color: var(--highlight);
        }
        .career-intro__badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 108px;
            padding: 18px 22px;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: var(--surface);
            box-shadow: var(--shadow);
            text-align: center;
        }
        .career-intro__count {
            font-family: var(--font-display);
            font-size: clamp(2.25rem, 4.5vw, 3.25rem);
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.04em;
            color: var(--highlight);
        }
        .career-intro__count-label {
            font-size: 0.625rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            line-height: 1.4;
            margin-top: 8px;
        }
        .career-intro__panel {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 20px 28px;
            align-items: center;
            padding: clamp(22px, 3.5vw, 30px) clamp(22px, 3.5vw, 32px);
            padding-left: clamp(26px, 3.5vw, 36px);
            border-radius: var(--radius-lg);
            border: 1px solid var(--line);
            background: linear-gradient(128deg, var(--surface) 0%, #faf8f5 55%, var(--bg-2) 100%);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }
        .career-intro__panel::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--highlight);
        }
        .career-intro__panel::after {
            content: "";
            position: absolute;
            right: -40px;
            top: -40px;
            width: 160px;
            height: 160px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(196, 92, 38, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }
        .career-intro__lead {
            font-size: clamp(1rem, 2vw, 1.0625rem);
            color: var(--muted);
            max-width: 54ch;
            margin: 0;
            position: relative;
            z-index: 1;
        }
        .career-intro__lead strong {
            color: var(--text);
            font-weight: 600;
        }
        .career-intro__tracks {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
            position: relative;
            z-index: 1;
        }

        .hero {
            padding: clamp(100px, 14vh, 140px) 0 clamp(48px, 8vh, 72px);
            position: relative;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(260px, 380px);
            gap: clamp(32px, 6vw, 72px);
            align-items: end;
        }

        .hero-kicker {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .hero-name {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(3rem, 10vw, 5.75rem);
            line-height: 1.06;
            letter-spacing: -0.02em;
            margin-bottom: 20px;
        }
        .hero-name--typewriter {
            min-height: 1.2em;
        }
        .typewriter-inner {
            display: inline;
        }
        .hero-name #tw-greet {
            color: var(--text);
        }
        .hero-name #tw-name {
            color: var(--highlight);
        }
        .typewriter-caret {
            display: inline-block;
            width: 3px;
            height: 0.72em;
            margin-left: 4px;
            background: var(--highlight);
            vertical-align: -0.06em;
            border-radius: 1px;
            animation: caretBlink 0.95s steps(1, end) infinite;
        }
        .typewriter-caret.is-hidden {
            opacity: 0;
            animation: none;
        }
        .typewriter-caret.is-soft {
            opacity: 0.5;
            animation-duration: 1.2s;
        }
        @keyframes caretBlink {
            0%, 49% { opacity: 1; }
            50%, 100% { opacity: 0; }
        }

        .hero-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 14px;
            margin-bottom: 22px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            border: 1px solid var(--line-strong);
            background: var(--surface);
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--accent-soft);
        }
        .pill--dark {
            background: var(--accent);
            color: #f4f1ec;
            border-color: var(--accent);
        }

        .hero-tagline {
            font-size: clamp(1rem, 2vw, 1.25rem);
            font-weight: 500;
            letter-spacing: -0.02em;
            max-width: 52ch;
            color: var(--muted);
            margin-bottom: 28px;
        }
        .hero-tagline em {
            font-style: normal;
            color: var(--text);
            border-bottom: 2px solid var(--highlight);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 40px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            border-radius: 999px;
            padding: 14px 26px;
            font-size: 0.875rem;
            font-weight: 700;
            letter-spacing: 0.01em;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn-primary {
            background: var(--accent);
            color: #faf7f2;
            border: none;
            box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        }
        .btn-primary:hover { background: #000; }
        .btn-ghost {
            border: 1px solid var(--line-strong);
            color: var(--text);
            background: transparent;
        }
        .btn-ghost:hover {
            background: var(--surface);
            box-shadow: var(--shadow);
        }

        .hero-side {
            position: relative;
            justify-self: end;
            width: 100%;
            max-width: 360px;
        }

        .hero-portrait-wrap {
            position: relative;
            animation: heroFloat 7s ease-in-out infinite;
        }
        @keyframes heroFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .hero-portrait {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: linear-gradient(145deg, #e8e2da, #d4cdc3);
            box-shadow: var(--shadow);
            aspect-ratio: 3 / 4;
        }

        .hero-portrait-frame {
            width: 100%;
            height: 100%;
        }
        .hero-portrait-frame--cutout {
            background: transparent;
        }

        .hero-portrait-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 8%;
            display: block;
            transform: scale(1.08);
        }
        .hero-portrait-img--cutout {
            object-fit: contain;
            object-position: center bottom;
            transform: scale(1.04);
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.15));
        }

        .hero-card-cap {
            margin-top: 16px;
            padding: 16px 18px;
            border-radius: var(--radius);
            border: 1px solid var(--line);
            background: var(--surface);
            font-size: 0.875rem;
        }
        .hero-card-cap strong {
            display: block;
            font-family: var(--font-display);
            font-weight: 700;
            margin-bottom: 4px;
        }
        .hero-card-cap span { color: var(--muted); font-size: 0.8125rem; }

        /* Marquee */
        .marquee-wrap {
            border-block: 1px solid var(--line);
            background: var(--accent);
            color: #f4f1ec;
            overflow: hidden;
            margin-top: 8px;
        }
        .marquee {
            display: flex;
            width: max-content;
            animation: marquee 70s linear infinite;
        }
        .marquee span {
            flex-shrink: 0;
            padding: 18px 48px;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(1rem, 2.5vw, 1.35rem);
            letter-spacing: -0.02em;
            white-space: nowrap;
        }
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* Sections */
        section { padding: clamp(56px, 10vh, 96px) 0; }

        .section-label {
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 12px;
        }

        .section-title {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(2rem, 4.5vw, 3rem);
            letter-spacing: -0.025em;
            line-height: 1.18;
            margin-bottom: 16px;
        }

        .section-lead {
            color: var(--muted);
            max-width: 56ch;
            font-size: 1.05rem;
            margin-bottom: 36px;
        }

        .split-about {
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(0, 0.9fr);
            gap: clamp(28px, 5vw, 56px);
            align-items: start;
        }

        .about-copy {
            font-size: 1.0625rem;
            color: var(--muted);
        }
        .about-copy p + p { margin-top: 16px; }

        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skill-tags span {
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid var(--line);
            background: var(--surface);
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--accent-soft);
        }

        /* Case study cards */
        .cs-grid {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        .cs-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.05fr);
            gap: 0;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--line);
            background: var(--surface);
            box-shadow: var(--shadow);
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
        }
        .cs-card:hover {
            box-shadow: var(--shadow-hover);
        }

        .cs-visual {
            min-height: 280px;  
            background: linear-gradient(135deg, #dcd4c8 0%, #c4b8a8 45%, #a89888 100%);
            position: relative;
            display: flex;
            align-items: flex-end;
            padding: 28px;
        }
        .cs-visual::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.35), transparent 55%);
            pointer-events: none;
        }
        .cs-visual-inner {
            position: relative;
            z-index: 1;
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(2rem, 5vw, 3rem);
            letter-spacing: -0.02em;
            color: rgba(18, 18, 18, 0.22);
            line-height: 1.12;
            overflow-wrap: break-word;
        }
        .cs-visual--image {
            padding: clamp(28px, 4vw, 44px);
            align-items: center;
            justify-content: center;
            background: #ece8e2;
        }
        .cs-visual--image::after {
            opacity: 0;
        }
        .cs-visual--vms,
        .cs-visual--connect,
        .cs-visual--fms,
        .cs-visual--reactions,
        .cs-visual--wearshare,
        .cs-visual--catty {
            background: linear-gradient(145deg, #0c2340 0%, #153d6b 42%, #1e5a96 100%);
            min-height: 320px;
        }
        .cs-visual--reactions {
            background: linear-gradient(145deg, #0a2844 0%, #125a8c 45%, #1a7ab8 100%);
        }
        .cs-visual--wearshare {
            background: linear-gradient(145deg, #0f2744 0%, #1a3d66 42%, #d96b2b 100%);
        }
        .cs-visual--catty {
            background: linear-gradient(145deg, #1f2937 0%, #374151 38%, #f6b73c 100%);
        }
        .cs-visual--vms::before,
        .cs-visual--connect::before,
        .cs-visual--fms::before,
        .cs-visual--reactions::before,
        .cs-visual--wearshare::before,
        .cs-visual--catty::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 70% 55% at 92% 8%, rgba(196, 92, 38, 0.35), transparent 55%),
                radial-gradient(ellipse 50% 45% at 8% 92%, rgba(255, 255, 255, 0.1), transparent 50%),
                repeating-linear-gradient(
                    -12deg,
                    transparent,
                    transparent 18px,
                    rgba(255, 255, 255, 0.03) 18px,
                    rgba(255, 255, 255, 0.03) 19px
                );
            pointer-events: none;
        }
        .cs-visual-frame {
            position: relative;
            z-index: 1;
            width: 100%;
            border-radius: 14px;
            overflow: hidden;
            box-shadow:
                0 28px 70px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.14);
            transform: translateY(4px);
            transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.35s ease;
        }
        .cs-card:hover .cs-visual-frame {
            transform: translateY(0);
            box-shadow:
                0 36px 90px rgba(0, 0, 0, 0.45),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }
        .cs-visual-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            z-index: 2;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #f4f1ec;
            background: rgba(12, 35, 64, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
        }
        .cs-visual-img {
            position: relative;
            z-index: 1;
            width: 100%;
            height: auto;
            min-height: 0;
            max-height: clamp(220px, 32vw, 300px);
            object-fit: contain;
            object-position: center;
            display: block;
            background: linear-gradient(180deg, #f6f8fc 0%, #eef2f8 100%);
        }

        .cs-body { padding: clamp(24px, 4vw, 40px); display: flex; flex-direction: column; justify-content: center; }

        .cs-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 10px;
        }

        .cs-card h3 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(1.5rem, 2.8vw, 2rem);
            letter-spacing: -0.02em;
            line-height: 1.22;
            margin-bottom: 12px;
        }

        .cs-card p {
            color: var(--muted);
            font-size: 0.9375rem;
            line-height: 1.65;
            margin-bottom: 18px;
        }

        .cs-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }
        .cs-tags span {
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 6px 12px;
            border-radius: 999px;
            background: var(--bg-2);
            color: var(--accent-soft);
        }

        .cs-links {
            display: flex;
            flex-wrap: wrap;
            gap: 12px 18px;
        }
        .cs-links a {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--text);
            text-decoration: none;
            border-bottom: 2px solid var(--text);
            padding-bottom: 2px;
            transition: color 0.2s ease, border-color 0.2s ease;
        }
        .cs-links a:hover {
            color: var(--highlight);
            border-color: var(--highlight);
        }

        /* Generic cards (org, skills, cert) */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .card {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 22px 24px;
            background: var(--surface);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }
        .card h3 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 1.125rem;
            margin-bottom: 10px;
        }
        .card p { font-size: 0.9375rem; color: var(--muted); }

        .org-period {
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 8px;
        }

        .cert-columns {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }
        .cert-stack {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .cert-box--featured {
            border-color: rgba(196, 92, 38, 0.22);
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(244, 241, 236, 0.95) 100%);
        }
        .cert-box--featured h3 {
            color: var(--text);
        }
        .cert-box__label {
            display: inline-block;
            font-size: 0.6875rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--highlight);
            margin-bottom: 8px;
        }
        .cert-box {
            border: 1px solid var(--line);
            border-radius: var(--radius);
            padding: 24px;
            background: var(--surface);
        }
        .cert-box h3 {
            font-family: var(--font-display);
            font-weight: 700;
            margin-bottom: 14px;
        }
        .cert-list {
            list-style: none;
            display: grid;
            gap: 10px;
            font-size: 0.875rem;
            color: var(--muted);
        }
        .cert-list li {
            padding-left: 16px;
            position: relative;
        }
        .cert-list li::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0.55em;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--highlight);
        }
        .cert-list a {
            color: var(--text);
            font-weight: 600;
            text-decoration: none;
            border-bottom: 1px solid transparent;
        }
        .cert-list a:hover { border-color: var(--highlight); color: var(--highlight); }
        .cert-drive-note {
            margin-top: 16px;
            font-size: 0.875rem;
            color: var(--muted);
        }
        .cert-drive-note a { color: var(--highlight); font-weight: 700; }

        /* Contact CTA */
        .cta-block {
            border-radius: var(--radius-lg);
            padding: clamp(40px, 8vw, 72px);
            background: var(--accent);
            color: #f4f1ec;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-block::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(196, 92, 38, 0.35), transparent 70%);
            top: -40%;
            right: -10%;
            pointer-events: none;
        }
        .cta-block h2 {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: clamp(2rem, 5vw, 3.25rem);
            letter-spacing: -0.02em;
            line-height: 1.12;
            margin-bottom: 14px;
            position: relative;
        }
        .cta-block > p {
            color: rgba(244, 241, 236, 0.75);
            max-width: 48ch;
            margin: 0 auto 28px;
            font-size: 1.0625rem;
            position: relative;
        }
        .cta-block .btn-primary {
            background: #f4f1ec;
            color: var(--accent);
            position: relative;
        }
        .cta-block .btn-primary:hover {
            background: #fff;
        }

        .contact-inline {
            margin-top: 20px;
            font-size: 0.9375rem;
            color: rgba(244, 241, 236, 0.7);
            position: relative;
        }
        .contact-inline a {
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.35);
        }
        .contact-inline a:hover { border-color: #fff; }

        footer {
            padding: 28px 0 40px;
            text-align: center;
            font-size: 0.8125rem;
            color: var(--muted);
            border-top: 1px solid var(--line);
            position: relative;
            z-index: 2;
        }

        [data-reveal] {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        [data-reveal].show {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 960px) {
            .hero-grid { grid-template-columns: 1fr; }
            .hero-side {
                justify-self: center;
                max-width: 320px;
            }
            .cs-card { grid-template-columns: 1fr; }
            .cs-visual { min-height: 200px; }
            .split-about { grid-template-columns: 1fr; }
            .grid-2, .grid-3, .cert-columns { grid-template-columns: 1fr; }
            .career-intro__panel { grid-template-columns: 1fr; }
            .career-intro__tracks { justify-content: flex-start; }
        }

        @media (max-width: 720px) {
            .career-intro__head { grid-template-columns: 1fr; }
            .career-intro__badge {
                flex-direction: row;
                gap: 14px;
                align-self: start;
                min-width: 0;
                padding: 14px 18px;
            }
            .career-intro__count-label { margin-top: 0; text-align: left; }
            .experience-stack { padding-left: 0; }
            .experience-stack::before,
            .experience-stack .card::before { display: none; }
            .nav-toggle { display: inline-flex; align-items: center; }
            .nav-links {
                position: fixed;
                inset: 72px 16px auto 16px;
                flex-direction: column;
                align-items: stretch;
                padding: 16px;
                border-radius: var(--radius);
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.96);
                backdrop-filter: blur(12px);
                box-shadow: var(--shadow);
                opacity: 0;
                pointer-events: none;
                transform: translateY(-8px);
                transition: opacity 0.25s ease, transform 0.25s ease;
            }
            .nav-links.is-open {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }
            .nav-links a {
                padding: 12px 14px;
                border-radius: 12px;
            }
            .nav-links a:hover { background: var(--bg); }
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition-duration: 0.01ms !important; scroll-behavior: auto !important; }
            .marquee-wrap { display: none; }
            .typewriter-caret { opacity: 0 !important; }
        }
    </style>
</head>
<body>
    <div class="grain" aria-hidden="true"></div>

    <header class="header" id="site-header">
        <div class="container nav">
            <a class="brand" href="#home">Najla.</a>
            <button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="nav-menu">Menu</button>
            <ul class="nav-links" id="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#tentang">About</a></li>
                <li><a href="#pengalaman-profesional">Experience</a></li>
                <li><a href="#proyek">Projects</a></li>
                <li><a href="#sertifikasi">Certifications</a></li>
                <li><a href="#kontak">Contact</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section class="hero container" id="home">
            <div class="hero-grid">
                <div data-reveal>
                    <p class="hero-kicker">Portfolio · Software engineer</p>
                    <h1 class="hero-name hero-name--typewriter" id="hero-headline" aria-live="polite">
                        <span class="typewriter-inner">
                            <span id="tw-greet"></span><span id="tw-name"></span><span class="typewriter-caret" id="typewriter-caret" aria-hidden="true"></span>
                        </span>
                    </h1>
                    <div class="hero-meta-row">
                        <span class="pill pill--dark">Software Engineering</span>
                        <span class="pill">IPB University</span>
                        <span class="pill">Tangerang, ID</span>
                    </div>
                    <p class="hero-tagline">I build scalable web &amp; backend systems focused on functionality, scalability, and business value, with a growing interest in Business Analysis and Project Management.</p>
                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#proyek">View work</a>
                        <a class="btn btn-ghost" href="#kontak">Contact</a>
                    </div>
                    <div class="hero-meta-row" style="margin-bottom:0;">
                        <span class="pill">13+ projects</span>
                        <span class="pill">9+ certifications</span>
                        <span class="pill">Education 2021–2025</span>
                    </div>
                </div>

                @php
                    $heroCutoutPath = public_path('images/najla-cutout.png');
                    $heroUseCutout = is_file($heroCutoutPath);
                @endphp
                <aside class="hero-side" data-reveal>
                    <div class="hero-portrait-wrap">
                        <div class="hero-portrait">
                            <div class="hero-portrait-frame{{ $heroUseCutout ? ' hero-portrait-frame--cutout' : '' }}">
                                <img
                                    class="hero-portrait-img{{ $heroUseCutout ? ' hero-portrait-img--cutout' : '' }}"
                                    src="{{ $heroUseCutout ? asset('images/najla-cutout.png') : asset('images/najla-intro.png') }}"
                                    alt="Najla Putri Afifah"
                                    width="400"
                                    height="500"
                                    decoding="async"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="hero-card-cap">
                        <strong>Najla Putri Afifah</strong>
                        <span>Fresh graduate in Software Engineering Technology from IPB University with BNSP certification and experience in backend development.</span>
                    </div>
                </aside>
            </div>
        </section>

        <div class="marquee-wrap" aria-hidden="true">
            <div class="marquee">
                @foreach (range(1, 2) as $marqueeRepeat)
                    <span>Backend Developer · Business Analysis Enthusiast · API Development · Requirement Analysis · System Optimization ·</span>
                    <span>Backend Developer · Business Analysis Enthusiast · API Development · Requirement Analysis · System Optimization ·</span>
                    <span>Backend Developer · Business Analysis Enthusiast · API Development · Requirement Analysis · System Optimization ·</span>
                    <span>Backend Developer · Business Analysis Enthusiast · API Development · Requirement Analysis · System Optimization ·</span>
                @endforeach
            </div>
        </div>

        <section id="tentang" class="container" data-reveal>
            <p class="section-label">About</p>
            <h2 class="section-title">Turning ideas into <br>functional systems & digital experiences.</h2>
            <p class="section-lead">Fresh graduate in Software Engineering Technology from IPB University with hands-on experience in backend and web development. Throughout my experience, I have developed an interest in understanding business requirements, analyzing processes, and aligning technology solutions with organizational goals. Passionate about Business Analysis and Project Management, with a technical background that helps bridge communication between business stakeholders and development teams.</p>
            <div class="split-about">
                <div class="about-copy">
                    <p>I am committed to delivering high quality work, capable of working independently as well as collaboratively in a team, with a strong sense of responsibility and discipline.</p>
                    <p>Quick contact: <a href="mailto:najlaputriafifah16@gmail.com"><strong>Email</strong></a> · <a href="https://www.linkedin.com/in/najla-putri-afifah" rel="noopener noreferrer" target="_blank"><strong>LinkedIn</strong></a></p>
                </div>
                <div>
                </div>
            </div>
        </section>

        <section id="pengalaman-profesional" class="container" data-reveal>
            <div class="career-intro">
                <div class="career-intro__head">
                    <div>
                        <p class="section-label">Career</p>
                        <h2 class="section-title">Professional<br>experience<span class="career-intro__dot">.</span></h2>
                    </div>
                    <div class="career-intro__badge" aria-label="3 professional roles">
                        <span class="career-intro__count">03</span>
                        <span class="career-intro__count-label">Roles<br>documented</span>
                    </div>
                </div>
                <div class="career-intro__panel">
                    <p class="career-intro__lead">Roles across <strong>backend</strong>, <strong>full-stack</strong>, and <strong>mobile</strong> — from industry and government to intensive academy cohorts.</p>
                    <ul class="career-intro__tracks" aria-label="Experience contexts">
                        <li><span class="pill pill--dark">Industry</span></li>
                        <li><span class="pill">Government</span></li>
                        <li><span class="pill">Academy</span></li>
                    </ul>
                </div>
            </div>
            <div class="experience-stack">
                <article class="card tilt" data-reveal>
                    <div class="org-period">August 2025 – Present</div>
                    <h3>CKL Cargo</h3>
                    <p><strong>Web Developer</strong> — in a logistics company, responsible for server side logic, APIs, and data layers that support day to day operations — building reliable backend systems from complex supply chain and business workflows.</p>
                </article>
                <article class="card tilt" data-reveal>
                    <div class="org-period">July 2024 – December 2024</div>
                    <h3>Dinas Komunikasi dan Informatika</h3>
                    <p><strong>Fullstack Developer</strong> — web applications, data workflows, and user-facing features for government digital services.</p>
                </article>
                <article class="card tilt" data-reveal>
                    <div class="org-period">February 2024 – June 2024</div>
                    <h3>Bangkit Academy</h3>
                    <p><strong>Mobile Developer (cohort)</strong> — intensive program led by Google, Tokopedia, Gojek, &amp; Traveloka focus on Android development, fundamentals, and capstone-ready engineering practices.</p>
                </article>
            </div>
        </section>

        <section id="proyek" class="container" data-reveal>
            <p class="section-label">Selected work</p>
            <h2 class="section-title">Projects &amp;<br>case studies.</h2>
            <p class="section-lead">A mix of campus projects, Bangkit capstones, collaborations, and prototypes — each with demos, drives, or certificates where available.</p>

            <div class="cs-grid">
                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--vms">
                        <span class="cs-visual-badge">CKL · VMS</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/vms-showcase.png') }}"
                                alt="CKL Vendor Management System — logistics platform screens"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">CKL · Logistics platform</p>
                        <h3>Vendor Management System</h3>
                        <p>CKL Cargo Vendor Management System (VMS) is a centralized platform that streamlines vendor operations — from onboarding and management to purchase order creation — empowering smarter, faster, and more efficient mid-mile logistics.</p>
                        <div class="cs-tags"><span>PHP</span><span>Laravel</span><span>APIs</span><span>SQL</span></div>
                        <div class="cs-links">
                            <a href="{{ route('projects.vms') }}">View project details →</a>
                            <a href="https://sandbox.vendor.cklcargo.com/" rel="noopener noreferrer" target="_blank">Visit website →</a>
                        </div>
                    </div>
                </article>

                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--connect">
                        <span class="cs-visual-badge">CKL · Connect</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/ckl-connect-showcase.png') }}"
                                alt="CKL Connect — logistics platform screens"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">CKL · Logistics platform</p>
                        <h3>CKL Connect</h3>
                        <p>CKL Connect is a multi-agent shipping operations platform that lets cargo/logistics agents issue invoices, price domestic and international shipments (with live FX rates), track parcels through their lifecycle, and manage teams—with dashboards and role-based access for owners, admins, and staff.</p>
                        <div class="cs-tags"><span>Backend</span><span>PHP</span><span>APIs</span><span>Logistics</span></div>
                        <div class="cs-links">
                            <a href="{{ route('projects.connect') }}">View project details →</a>
                            <a href="https://sandbox.ckl-connect.cklcargo.com/login" rel="noopener noreferrer" target="_blank">Visit website →</a>
                        </div>
                    </div>
                </article>

                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--fms">
                        <span class="cs-visual-badge">CKL · FMS</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/fms-showcase.png') }}"
                                alt="CKL Fleet Management System — platform screens"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">CKL · Logistics platform</p>
                        <h3>Fleet Management System</h3>
                        <p>FMS is a logistics backend that registers trucks and drivers, plans delivery trips with routes and checkpoints, runs quality checks, lets drivers execute trips from a mobile app, and gives operations tools to monitor status and fix problems along the way.</p>
                        <div class="cs-tags"><span>Backend</span><span>PHP</span><span>APIs</span><span>Logistics</span></div>
                        <div class="cs-links">
                            <a href="{{ route('projects.fleet') }}">View project details →</a>
                            <a href="https://sandbox.fleet.cklcargo.com/login" rel="noopener noreferrer" target="_blank">Visit website →</a>
                        </div>
                    </div>
                </article>

                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--reactions">
                        <span class="cs-visual-badge">Kominfo · Re-Actions</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/re-actions-showcase.png') }}"
                                alt="Re-Actions — public complaint management system screens"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">Government · Public service</p>
                        <h3>Re-Actions</h3>
                        <p>Re-Actions is a web-based public complaint management system developed for the Tangerang City Government to streamline complaint handling, tracking, and data analysis. Built using CodeIgniter 4, MySQL, and JavaScript.</p>
                        <div class="cs-tags"><span>CodeIgniter 4</span><span>MySQL</span><span>JavaScript</span><span>Government</span></div>
                        <div class="cs-links">
                            <a href="{{ route('projects.reactions') }}">View project details →</a>
                        </div>
                    </div>
                </article>

                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--wearshare">
                        <span class="cs-visual-badge">Bangkit · WearShare</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/wearshare-showcase.png') }}"
                                alt="WearShare — Android app screens for clothing donation and ML detection"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">Bangkit · Mobile · ML</p>
                        <h3>WearShare</h3>
                        <p>Built WearShare, an Android application that utilizes machine learning to analyze images of donated clothing and determine whether each item is suitable for use or not, aimed at supporting clothing distribution in charitable organizations.</p>
                        <div class="cs-tags"><span>Kotlin</span><span>Android</span><span>Machine Learning</span><span>TFLite</span></div>
                        <div class="cs-links">
                            <a href="https://github.com/C241-PS306/mobile-development" rel="noopener noreferrer" target="_blank">View repository →</a>
                        </div>
                    </div>
                </article>

                <article class="cs-card tilt" data-reveal>
                    <div class="cs-visual cs-visual--image cs-visual--catty">
                        <span class="cs-visual-badge">Figma · Catty Holic</span>
                        <div class="cs-visual-frame">
                            <img
                                class="cs-visual-img"
                                src="{{ asset('images/projects/catty-holic-showcase.png') }}"
                                alt="Catty Holic — mobile UI design for cat health and adoption"
                                width="1200"
                                height="800"
                                loading="lazy"
                                decoding="async"
                            >
                        </div>
                    </div>
                    <div class="cs-body">
                        <p class="cs-eyebrow">Figma · Mobile UI</p>
                        <h3>Catty Holic</h3>
                        <p>Catty Holic is a UI application design created using Figma that provides mobile-based cat needs services. The application provides cat health consultations with veterinarians and includes a cat adoption feature where users can search for and see various types of cats that can be adopted.</p>
                        <div class="cs-tags"><span>Figma</span><span>UI/UX</span><span>Mobile</span><span>Prototype</span></div>
                        <div class="cs-links">
                            <a href="https://www.figma.com/proto/SFfqJAUHqUNtUFhNENbapN/cattyhollic?type=design&amp;node-id=1-6&amp;t=DcG3bd8DzdbhiCSL-1&amp;scaling=scale-down&amp;page-id=0%253A1&amp;starting-point-node-id=1%253A6&amp;show-proto-sidebar=1&amp;mode=design" rel="noopener noreferrer" target="_blank">Open prototype →</a>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section id="sertifikasi" class="container" data-reveal>
            <p class="section-label">Learning</p>
            <h2 class="section-title">Training &amp;<br>certifications.</h2>
            <p class="section-lead">Professional credentials, language certification, and Bangkit Academy learning paths — each with verifiable links where available.</p>
            <div class="cert-stack">
                <div class="cert-box cert-box--featured tilt" data-reveal>
                    <span class="cert-box__label">National certification</span>
                    <h3>BNSP · Software Engineer</h3>
                    <ul class="cert-list">
                        <li><a href="https://drive.google.com/file/d/1vV4yh5klz4aL3trnNSSX9GcE6bngQE63/view?usp=sharing" rel="noopener noreferrer" target="_blank">Software Engineer — BNSP professional certification</a></li>
                    </ul>
                </div>

                <div class="cert-box tilt" data-reveal>
                    <span class="cert-box__label">Language</span>
                    <h3>English · Business Communication</h3>
                    <ul class="cert-list">
                        <li><a href="https://drive.google.com/drive/home" rel="noopener noreferrer" target="_blank">English for Business Communication</a></li>
                    </ul>
                </div>

                <div class="cert-box tilt" data-reveal>
                    <span class="cert-box__label">Bangkit Academy · Dicoding</span>
                    <h3>Bangkit Academy</h3>
                    <ul class="cert-list">
                        <li><a href="https://www.dicoding.com/certificates/KEXL8N9V4ZG2" rel="noopener noreferrer" target="_blank">Getting Started with Programming Basics to Become a Software Developer</a></li>
                        <li><a href="https://www.dicoding.com/certificates/NVP77396RPR0" rel="noopener noreferrer" target="_blank">Introduction to Programming Logic (Programming Logic 101)</a></li>
                        <li><a href="https://www.dicoding.com/certificates/JLX12RLE2Z72" rel="noopener noreferrer" target="_blank">Learn Git Basics with GitHub</a></li>
                        <li><a href="https://www.dicoding.com/certificates/JMZVDVVQJZN9" rel="noopener noreferrer" target="_blank">Learn to Create a Web Front-End for Beginners</a></li>
                        <li><a href="https://www.dicoding.com/certificates/GRX5QEVYYZ0M" rel="noopener noreferrer" target="_blank">Getting Started Programming with Kotlin</a></li>
                        <li><a href="https://www.dicoding.com/certificates/MRZM83MQRZYQ" rel="noopener noreferrer" target="_blank">Learn to Make Android Applications for Beginners</a></li>
                        <li><a href="https://www.dicoding.com/certificates/ERZR19KV2ZYV" rel="noopener noreferrer" target="_blank">Learn Android Application Fundamentals</a></li>
                        <li><a href="https://www.dicoding.com/certificates/MEPJNRJDLX3V" rel="noopener noreferrer" target="_blank">Learn SOLID Programming Principles</a></li>
                        <li><a href="https://www.dicoding.com/certificates/KEXL14YOMXG2" rel="noopener noreferrer" target="_blank">Learn AI Basics</a></li>
                        <li><a href="https://www.dicoding.com/certificates/MRZMED52NPYQ" rel="noopener noreferrer" target="_blank">Learn to Apply Machine Learning for Android</a></li>
                    </ul>
                    <p class="cert-drive-note">Bangkit certificates (PDF): <a href="https://drive.google.com/file/d/13p5Ms8IfDX9RGWi0NACzFz4uKnZKOYD7/view?usp=sharing" rel="noopener noreferrer" target="_blank">open Drive</a></p>
                </div>
            </div>
        </section>

        <section id="kontak" class="container" data-reveal>
            <div class="cta-block">
                <h2>Let’s talk</h2>
                <p>I’m most energized by projects where I can learn fast, collaborate, and ship interfaces that feel clear and dependable.</p>
                <a class="btn btn-primary" href="mailto:najlaputriafifah16@gmail.com">Contact</a>
                <p class="contact-inline">
                    <a href="mailto:najlaputriafifah16@gmail.com">Email</a>
                    ·
                    <a href="https://www.linkedin.com/in/najla-putri-afifah" rel="noopener noreferrer" target="_blank">LinkedIn</a>
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">© {{ date('Y') }} Najla Putri Afifah · Portfolio</div>
    </footer>

    <script>
        (function () {
            function runTypewriter() {
                var greetText = "Hello, I'm ";
                var nameText = "Najla";
                var elGreet = document.getElementById("tw-greet");
                var elName = document.getElementById("tw-name");
                var headline = document.getElementById("hero-headline");
                var caret = document.getElementById("typewriter-caret");
                if (!elGreet || !elName || !headline) return;

                var reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
                if (reduced) {
                    elGreet.textContent = greetText;
                    elName.textContent = nameText;
                    headline.classList.add("is-done");
                    if (caret) caret.classList.add("is-hidden");
                    return;
                }

                var gi = 0;
                function stepGreet() {
                    if (gi < greetText.length) {
                        elGreet.textContent += greetText.charAt(gi);
                        gi++;
                        var c = greetText.charAt(gi - 1);
                        var delay = c === " " ? 120 : c === "," ? 200 : c === "'" ? 90 : 48;
                        window.setTimeout(stepGreet, delay);
                    } else {
                        window.setTimeout(startName, 280);
                    }
                }

                var ni = 0;
                function startName() {
                    ni = 0;
                    stepName();
                }

                function stepName() {
                    if (ni < nameText.length) {
                        elName.textContent += nameText.charAt(ni);
                        ni++;
                        var ch = nameText.charAt(ni - 1);
                        var d = ch === " " ? 70 : 55;
                        window.setTimeout(stepName, d);
                    } else {
                        headline.classList.add("is-done");
                        if (caret) caret.classList.add("is-soft");
                    }
                }

                stepGreet();
            }

            if (document.readyState === "loading") {
                document.addEventListener("DOMContentLoaded", runTypewriter);
            } else {
                runTypewriter();
            }

            var header = document.getElementById("site-header");
            var toggle = document.getElementById("nav-toggle");
            var menu = document.getElementById("nav-menu");

            function onScroll() {
                if (!header) return;
                header.classList.toggle("scrolled", window.scrollY > 24);
            }
            window.addEventListener("scroll", onScroll, { passive: true });
            onScroll();

            if (toggle && menu) {
                toggle.addEventListener("click", function () {
                    var open = menu.classList.toggle("is-open");
                    toggle.setAttribute("aria-expanded", open ? "true" : "false");
                });
                menu.querySelectorAll("a").forEach(function (a) {
                    a.addEventListener("click", function () {
                        menu.classList.remove("is-open");
                        toggle.setAttribute("aria-expanded", "false");
                    });
                });
            }

            var revealItems = document.querySelectorAll("[data-reveal]");
            var tiltCards = document.querySelectorAll(".tilt");

            if ("IntersectionObserver" in window) {
                var io = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("show");
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.12 });
                revealItems.forEach(function (item) { io.observe(item); });
            } else {
                revealItems.forEach(function (item) { item.classList.add("show"); });
            }

            tiltCards.forEach(function (card) {
                card.addEventListener("mousemove", function (e) {
                    var rect = card.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var rx = ((y / rect.height) - 0.5) * -5;
                    var ry = ((x / rect.width) - 0.5) * 6;
                    card.style.transform = "translateY(-6px) rotateX(" + rx + "deg) rotateY(" + ry + "deg)";
                });
                card.addEventListener("mouseleave", function () {
                    card.style.transform = "";
                });
            });
        })();
    </script>
</body>
</html>
