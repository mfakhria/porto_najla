# Deploy to Vercel

Portfolio aktif adalah Vite + React dan dapat dibangun langsung oleh Vercel tanpa PHP atau export Blade.

## Build settings

- Install command: `npm install`
- Build command: `npm run build`
- Output directory: `dist`

Konfigurasi tersebut sudah tersedia di `vercel.json`.

## Deploy otomatis

Tambahkan `VERCEL_TOKEN`, `VERCEL_ORG_ID`, dan `VERCEL_PROJECT_ID` pada GitHub Actions secrets. Setiap push ke `main` akan menjalankan workflow deployment.

## Verifikasi lokal

```bash
npm install
npm run build
npm run preview
```
