FROM php:8.2-fpm

# Instalar extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libpng-dev libonig-dev libxml2-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copiar archivos
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache

# Puerto por donde se ejecutará la app
EXPOSE 8000

# Comando para arrancar Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000
