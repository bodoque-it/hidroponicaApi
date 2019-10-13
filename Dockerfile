

FROM php:7.2-apache

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY public/ /var/www/html/public/
COPY src/ /var/www/html/src/
COPY app/ /var/www/html/app/
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf
# Including apache expires module
RUN ln -s /etc/apache2/mods-available/expires.load /etc/apache2/mods-enabled/
# Enabling module headers
RUN a2enmod headers

# Install git
RUN apt-get update && apt-get install -y git && apt-get install zip unzip

# Install php extensions
RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install libgmp-dev -y && \
    apt-get update && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file && \
    docker-php-ext-configure gmp && docker-php-ext-install gmp


# Copy composer into docker served directory
COPY ./composer.json /var/www/html/
COPY .env /var/www/html/
RUN composer install
# Enabling module rewrite
RUN a2enmod rewrite
RUN service apache2 restart
EXPOSE 80