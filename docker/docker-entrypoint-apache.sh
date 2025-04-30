#!/bin/bash

if [ ! -d vendor ]; then
    echo "--------------------------------------------------------"
    echo "Composer install"
    echo "--------------------------------------------------------"
    composer install --optimize-autoloader --no-interaction
fi

echo "--------------------------------------------------------"
echo "Start supervisord"
echo "--------------------------------------------------------"
exec supervisord -n -c /etc/supervisor/supervisord.conf
