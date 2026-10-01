#!/usr/bin/env bash
# One-shot setup for the Bnyan dashboard (Laravel 11).
# Requirements: PHP >= 8.2 (extensions: mbstring, pdo_sqlite or pdo_mysql, openssl, fileinfo, xml, ctype, json) and Composer.
set -euo pipefail
cd "$(dirname "$0")"

command -v php >/dev/null      || { echo "PHP is not installed (need >= 8.2)"; exit 1; }
command -v composer >/dev/null || { echo "Composer is not installed"; exit 1; }

composer install --no-interaction --prefer-dist

[ -f .env ] || cp .env.example .env
grep -q '^APP_KEY=.\+' .env || php artisan key:generate --force

# SQLite file (skip if you use MySQL)
if grep -q '^DB_CONNECTION=sqlite' .env; then
  mkdir -p database && touch database/database.sqlite
fi

chmod -R ug+rwx storage bootstrap/cache || true

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link || true
php artisan content:verify || echo "(content:verify reported differences — review above)"

echo
php artisan admin:show-url
echo "Run the server with:  php artisan serve"
