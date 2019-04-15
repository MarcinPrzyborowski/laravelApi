FROM php:7.3-fpm
WORKDIR /var/www

RUN apt-get update -yqq \
    && apt-get install git unzip -y

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer --version

# extract php-source
RUN docker-php-source extract

# install xdebug
RUN pecl install xdebug-2.7.0beta1 \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9002" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=docker" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear

# install pdo_mysql
RUN docker-php-ext-install pdo_mysql

# install bc-math
RUN docker-php-ext-install bcmath

# install redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# clear php-source
RUN docker-php-source delete

RUN useradd app
RUN mkdir /home/app
RUN chown app:app /home/app

USER app

EXPOSE 9000