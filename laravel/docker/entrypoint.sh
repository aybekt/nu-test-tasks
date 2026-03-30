#!/bin/sh
set -e

cd /var/www/html

touch database/database.sqlite

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    php artisan key:generate --force --no-interaction
fi

chown -R www-data:www-data storage bootstrap/cache database || true

exec "$@"
