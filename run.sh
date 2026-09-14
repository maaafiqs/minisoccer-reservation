#!/bin/sh

echo "==> Menjalankan migrasi database & seeder..."
php artisan migrate --force --seed

echo "==> Membuat link storage..."
php artisan storage:link || true

echo "==> Mengoptimalkan cache..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "==> Menjalankan web server..."
exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
