#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- php-fpm "$@"
fi

if [ "$1" = 'php-fpm' ] || [ "$1" = 'php' ]; then
	PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-production"
	if [ "$APP_ENV" != 'prod' ]; then
		PHP_INI_RECOMMENDED="$PHP_INI_DIR/php.ini-development"
	fi
	ln -sf "$PHP_INI_RECOMMENDED" "$PHP_INI_DIR/php.ini"

#	setfacl -R -m u:www-data:rwX -m u:"$(whoami)":rwX storage
#	setfacl -dR -m u:www-data:rwX -m u:"$(whoami)":rwX storage

#	if [ "$APP_ENV" != 'prod' ]; then
#		composer install --prefer-dist --no-progress --no-suggest --no-interaction
#		php artisan migrate
#	fi
fi

exec docker-php-entrypoint "$@"
