# Deploy to Vercel

Portfolio ini **bukan** static HTML biasa — Blade perlu di-export dulu ke folder `dist/`.

## Kenapa error "No Output Directory named dist"?

1. **Vercel tidak punya PHP** di server build — tidak bisa render Blade.
2. **`vercel.json` harus ada di GitHub** — kalau belum di-push, Vercel pakai preset Vite/Node dan cari folder `dist` dari `npm run build` (gagal).

Solusi: **GitHub Actions** build dengan PHP → export ke `dist/` → deploy ke Vercel.

---

## Setup (sekali saja)

### 1. Token Vercel
1. https://vercel.com/account/tokens → **Create Token**
2. Copy token

### 2. ID project
Di folder project (lokal), jalankan:
```bash
npx vercel link
```
Lalu buka file `.vercel/project.json` — catat `orgId` dan `projectId`.

Atau: Vercel Dashboard → Project → **Settings** → General → Project ID / Team ID.

### 3. GitHub Secrets
Repo GitHub → **Settings** → **Secrets and variables** → **Actions** → **New repository secret**:

| Name | Value |
|------|--------|
| `VERCEL_TOKEN` | token dari langkah 1 |
| `VERCEL_ORG_ID` | orgId |
| `VERCEL_PROJECT_ID` | projectId |

### 4. Matikan auto-deploy Vercel (disarankan)
Vercel Dashboard → Project → **Settings** → **Git** → **Ignored Build Step**  
Atau nonaktifkan deploy otomatis supaya hanya GitHub Action yang deploy (build PHP jalan di GitHub, bukan di Vercel).

Alternatif: biarkan auto-deploy, tapi deploy yang sukses akan dari **Actions** setelah secrets diset.

---

## Deploy otomatis

Setiap `git push` ke `main` → GitHub Action:
1. Install PHP + Composer
2. `php scripts/build-static.php` → folder `dist/`
3. Deploy ke Vercel

---

## Build lokal (opsional)

```bash
composer install
php scripts/build-static.php
```

Hasil ada di `dist/` — bisa di-preview dengan static server.

---

## Catatan

- **GitHub Pages (`github.io`)** tetap tidak bisa menjalankan Laravel.
- **Render** (Docker) = Laravel penuh; **Vercel** = versi static (cukup untuk portfolio ini).
- Setelah ubah `welcome.blade.php`, push ke GitHub — Action akan rebuild otomatis.
