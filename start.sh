#!/bin/sh

# Run the database migrations
php artisan migrate --force

# Run the command to fetch all the data
php artisan movies:fetch

# Start the Laravel server
php artisan serve --host 0.0.0.0 --port 10000