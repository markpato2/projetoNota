# docker/php/Dockerfile
FROM php:7.3-fpm

RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get install git -y autoconf pkg-config libssl-dev
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini


# Install Composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer