# Use the official PHP image with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && a2enmod rewrite

# Install Composer globally
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents to working directory
COPY . /var/www/html

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Install npm dependencies for Tailwind
RUN npm install

# Build Tailwind CSS
RUN npm run build

# Expose port 80
EXPOSE 80

# Start Apache in foreground mode (for Docker)
# CMD ["apache2-foreground php artisan serve --host=0.0.0.0 --port=80", ]

CMD php artisan serve --host=0.0.0.0 --port=80
