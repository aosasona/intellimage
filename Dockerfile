FROM php:8.0-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y libpq-dev \
  && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

RUN chown -R www-data:www-data /var/www

RUN echo "file_uploads = On" >> /usr/local/etc/php/php.ini \
  && echo "upload_max_filesize = 100M" >> /usr/local/etc/php/php.ini \
  && echo "post_max_size = 100M" >> /usr/local/etc/php/php.ini \
  && echo "memory_limit = 256M" >> /usr/local/etc/php/php.ini

COPY composer.json .

RUN composer install

COPY . .

EXPOSE 80

CMD ["apache2-foreground"]
