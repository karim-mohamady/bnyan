@echo off
cd /d "%~dp0"
call composer install --no-interaction --prefer-dist || exit /b 1
if not exist .env copy .env.example .env
findstr /b /c:"APP_KEY=base64" .env >nul || php artisan key:generate --force
if not exist database\database.sqlite type nul > database\database.sqlite
php artisan migrate --force || exit /b 1
php artisan db:seed --force || exit /b 1
php artisan storage:link
php artisan admin:show-url
echo Run the server with:  php artisan serve
