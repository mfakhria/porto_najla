#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT"

install_php_if_needed() {
  if command -v php >/dev/null 2>&1; then
    php -v
    return 0
  fi

  echo "PHP not found — attempting install..."

  if command -v dnf >/dev/null 2>&1; then
    dnf install -y php-cli php-xml php-mbstring php-json php-tokenizer php-curl php-zip php-opcache 2>/dev/null || true
  fi

  if command -v apt-get >/dev/null 2>&1; then
    apt-get update -y 2>/dev/null || true
    apt-get install -y php-cli php-xml php-mbstring php-json php-tokenizer php-curl php-zip 2>/dev/null || true
  fi

  command -v php >/dev/null 2>&1
}

if ! install_php_if_needed; then
  echo "ERROR: PHP is required to export Blade templates for Vercel."
  echo "Use Render (Docker) for full Laravel, or run locally: php scripts/build-static.php && vercel deploy --prebuilt"
  exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
  curl -sS https://getcomposer.org/installer | php
  php composer.phar install --no-dev --optimize-autoloader --no-interaction
else
  composer install --no-dev --optimize-autoloader --no-interaction
fi

php scripts/build-static.php

if [ ! -f dist/index.html ]; then
  echo "ERROR: dist/index.html was not created."
  exit 1
fi

echo "Vercel build ready in dist/"
