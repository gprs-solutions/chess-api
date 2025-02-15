FROM php:8-fpm-alpine

# Install system dependencies and required libraries
RUN apk update && apk add --no-cache \
    build-base \
    curl \
    git \
    zip \
    unzip \
    bash \
    oniguruma-dev \
    libxml2-dev \
    entr

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql mbstring xml pcntl

# Install Swoole via PECL for Octane
RUN apk add --no-cache $PHPIZE_DEPS brotli-dev && \
    pecl install swoole && \
    docker-php-ext-enable swoole && \
    apk del $PHPIZE_DEPS

# Disable OPCache for development
RUN echo "opcache.enable=0" > /usr/local/etc/php/conf.d/opcache-dev.ini

# Install Composer from the official Composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . /var/www

# Install application dependencies
RUN rm -rf /var/www/vendor && rm -rf /var/www/composer.lock
RUN composer install --no-interaction

# Ensure correct file permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose port 8000 
EXPOSE 8000

# Copy the entrypoint script into the container
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Use the entrypoint script and start Laravel Octane using Swoole (swoole default wather does not work with Docker well so we use entr)
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["/usr/local/bin/php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0", "--port=8000"]
