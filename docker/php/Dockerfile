# Base image for PHP with FPM
FROM php:8.3-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl

# Set working directory
WORKDIR /var/www/html

# Set permissions for Laravel storage and bootstrap cache directories
# RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy site-specific Nginx configuration to the conf.d directory
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose port 80 for Nginx
EXPOSE 80

# Copy a startup script to start both Nginx and PHP-FPM
COPY ./docker/docker-entrypoint.sh /usr/local/bin/

# Ensure the entrypoint script is executable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set the entrypoint to run the custom startup script
ENTRYPOINT ["docker-entrypoint.sh"]
