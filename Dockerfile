# Dockerfile

FROM php:7.4-apache

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY start-apache /usr/local/bin

RUN chmod 755 /usr/local/bin/start-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY /app /var/www/html

CMD ["start-apache"]