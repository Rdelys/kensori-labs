# Étape 1 : Image PHP avec les extensions nécessaires
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances système
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    nano \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Étape 3 : Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Étape 4 : Copier les fichiers Laravel
WORKDIR /var/www
COPY . .

# Étape 5 : Installer les dépendances Laravel
RUN composer install --no-dev --optimize-autoloader

# Étape 6 : Donner les permissions aux dossiers nécessaires
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Port exposé
EXPOSE 8000

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8000
