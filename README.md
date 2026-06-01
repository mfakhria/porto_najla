# Portfolio — Najla Putri Afifah

Personal portfolio website built with **Laravel** and Blade.

## Stack

- PHP / Laravel
- Blade templates
- Static assets (CSS, images)

## Local setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Open `http://127.0.0.1:8000`.

## Deploy (Render — live website)

GitHub Pages **cannot** run Laravel. Use [Render](https://render.com) (free tier):

1. Push this repo to GitHub (`najlaput16/portofolio-najlaput`).
2. Open [Render Dashboard](https://dashboard.render.com) → **New** → **Blueprint**.
3. Connect GitHub repo `portofolio-najlaput` → Render reads `render.yaml` automatically.
4. Wait for deploy (~5–10 min). URL: `https://portofolio-najlaput.onrender.com` (name may vary).
5. In Render → **Environment**, set `APP_URL` to your live URL (e.g. `https://portofolio-najlaput.onrender.com`).
6. **GitHub Pages:** Settings → Pages → **None** (avoid showing README instead of the app).

Manual deploy (without Blueprint): **New Web Service** → Docker → repo root → same env vars as `render.yaml`.

## Project detail pages

- `/projects/vms`
- `/projects/connect`
- `/projects/fleet`
- `/projects/re-actions`

## License

MIT — portfolio content © Najla Putri Afifah.
