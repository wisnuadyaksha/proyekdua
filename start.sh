#!/bin/bash
touch database/database.sqlite
php artisan migrate --force
apache2-foreground
