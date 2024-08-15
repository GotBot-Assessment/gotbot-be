FROM composer as composer

FROM php:8.3-apache as apache
LABEL authors="Innocent Mazando"
LABEL project="GotBot Chef"

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

#copy composer files to install dependencies.
COPY . .

#updating apache root directory.
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#install php extensions required for the app.
RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libpq-dev \
		unzip \
	&& docker-php-ext-configure exif \
	&& docker-php-ext-install -j$(nproc) exif

# Configure and install pgsql extension
RUN docker-php-ext-install pdo pdo_pgsql

RUN composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

#copy env file.
RUN cp .env.example .env

#make bootstrap writable.
RUN chmod -R 777 storage bootstrap/cache

#Linking storage.
RUN php artisan storage:link

#Generate appkey.
RUN php artisan key:generate

#Generate auth keys.
RUN php artisan passport:keys --force
