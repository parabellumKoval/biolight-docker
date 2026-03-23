#!/bin/sh
set -e

cd /var/www/html

mkdir -p \
  storage/app/public \
  storage/framework/cache/data \
  storage/framework/sessions \
  storage/framework/views \
  storage/logs \
  bootstrap/cache \
  public/uploads

if [ -d /opt/seed/public/uploads ] && [ -z "$(find public/uploads -mindepth 1 -maxdepth 1 -print -quit 2>/dev/null)" ]; then
  cp -a /opt/seed/public/uploads/. public/uploads/
fi

chown -R www-data:www-data storage bootstrap/cache public/uploads || true

if [ "${RUN_MIGRATIONS:-false}" = "true" ]; then
  php artisan migrate --force
fi

php artisan storage:link || true

if [ "$#" -gt 0 ]; then
  exec "$@"
fi

exec php artisan serve --host=0.0.0.0 --port=8080
