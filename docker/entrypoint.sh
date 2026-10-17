#!/bin/sh
set -e

cd /var/www/html

[ -f .env ] || cp .env.example .env

# `artisan serve` ignora las variables de entorno que ya estan en .env,
# por eso se sincronizan los valores de la base de datos en el archivo.
for var in DB_HOST DB_PORT DB_DATABASE DB_USERNAME DB_PASSWORD; do
    eval "value=\${$var}"
    if [ -n "$value" ]; then
        sed -i "s|^$var=.*|$var=$value|" .env
    fi
done

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

if ! grep -q '^APP_KEY=.\+' .env; then
    php artisan key:generate --force
fi

if [ "$RUN_MIGRATIONS" = "true" ]; then
    until php artisan migrate --force; do
        echo "Esperando a la base de datos..."
        sleep 3
    done
    php artisan storage:link 2>/dev/null || true
fi

exec "$@"
