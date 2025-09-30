#!/bin/sh

# Force Laravel to clear any old settings
php artisan config:clear

# Force Laravel to create a new settings cache file with the latest keys from Render
php artisan config:cache

# Run the database migrations
php artisan migrate --force

# Run the command to fetch all the data
php artisan movies:fetch

# Start the Laravel server
php artisan serve --host 0.0.0.0 --port 10000