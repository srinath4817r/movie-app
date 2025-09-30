# Use the official PHP 8.2 image with FPM
FROM php:8.2-fpm as vendor

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist

# --- Final Stage ---
FROM php:8.2-fpm

WORKDIR /app

# Copy vendor dependencies and application code
COPY --from=vendor /app/vendor ./vendor
COPY . .

# MODIFIED: Copy the new start.sh script
COPY start.sh /app/start.sh
# MODIFIED: Make the script executable
RUN chmod +x /app/start.sh

# Set permissions
RUN chown -R www-data:www-data /app

USER www-data

EXPOSE 10000

# MODIFIED: Run the new start.sh script as the main command
CMD ["/app/start.sh"]