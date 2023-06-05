FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev  libzip-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql




RUN rm /etc/apt/preferences.d/no-debian-php
RUN apt-get update && apt-get install -y libxml2-dev \
    && pear install -a SOAP-0.13.0 \
    && docker-php-ext-install soap;

RUN pecl upgrade timezonedb \
    && bash -c "echo extension=timezonedb.so > /usr/local/etc/php/conf.d/docker-php-ext-timezonedb.ini"

RUN docker-php-ext-install zip
RUN docker-php-ext-install exif

RUN apt-get install -y cron wget nano

# RUN apt-get --allow-releaseinfo-change update && apt-get install -y \
#    ffmpeg \
#    libfreetype6-dev \
#    libjpeg62-turbo-dev \
#    libpng-dev \
#    && docker-php-ext-configure gd --with-jpeg-dir --with-freetype-dir \
#    && docker-php-ext-install -j$(nproc) gd

# RUN apt-get install -y \
#    libmagickwand-dev --no-install-recommends \
#    && pecl install imagick \
#	&& docker-php-ext-enable imagick

RUN apt-get update && apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

RUN rm -rf /var/lib/apt/lists/*


RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer


RUN sed -i 's/SECLEVEL=2/SECLEVEL=1/g' /etc/ssl/openssl.cnf

ENV TZ=Asia/Tehran
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone


WORKDIR /var/www/app/private
RUN chown -R www-data:www-data /var/www
EXPOSE 9000
