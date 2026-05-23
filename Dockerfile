# Stage 1: Build front-end assets
FROM node:20 AS assets-builder
WORKDIR /app
COPY package.json ./
RUN npm install
COPY assets/ ./assets/
COPY webpack.config.js ./
COPY postcss.config.js ./
COPY tailwind.config.js ./
COPY templates/ ./templates/
RUN npm run build

# Stage 2: Install Composer dependencies
FROM php:8.4-cli-alpine AS composer-builder
WORKDIR /app
RUN apk add --no-cache git unzip
COPY composer.json composer.lock ./
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=docker.io/library/composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Stage 3: Final production runtime image using FrankenPHP
FROM docker.io/dunglas/frankenphp:php8.4-alpine AS runtime
WORKDIR /app

# Install standard PHP extensions required by Symfony & MySQL
RUN apk add --no-cache \
    icu-dev \
    libzip-dev \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    intl \
    pdo_mysql \
    zip \
    gd \
    opcache

# Use production OPcache settings
RUN { \
        echo 'opcache.memory_consumption=256'; \
        echo 'opcache.max_accelerated_files=20000'; \
        echo 'opcache.validate_timestamps=0'; \
        echo 'opcache.realpath_cache_size=4096K'; \
        echo 'opcache.realpath_cache_ttl=600'; \
    } > /usr/local/etc/php/conf.d/opcache-prod.ini

# Copy project files
COPY --chown=www-data:www-data . .

# Copy built vendor and compiled assets from builders
COPY --chown=www-data:www-data --from=composer-builder /app/vendor/ ./vendor/
COPY --chown=www-data:www-data --from=assets-builder /app/public/build/ ./public/build/

# Create var directories and set permissions
RUN mkdir -p var/cache var/log \
    && chown -R www-data:www-data var \
    && chmod -R 775 var

# Configure environment for production
ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV FRANKENPHP_DOCUMENT_ROOT=/app/public

# Warm up Symfony cache for production environment
USER www-data
RUN php bin/console cache:clear --env=prod --no-debug

USER root
