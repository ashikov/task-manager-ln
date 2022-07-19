FROM php:8.1-cli

ARG user
ARG uid=1000
ARG gid=1000

WORKDIR /app

RUN apt-get update && apt-get install -y \
    git \
    libpq-dev \
    libzip-dev \
    sqlite3 \
    zip \
    unzip \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    bcmath \
    exif \
    pdo \
    pdo_pgsql \
    pgsql \
    zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -

RUN apt-get install -y nodejs
RUN npm install --location=global npm@latest

RUN groupadd -g $gid -o tmanager
RUN useradd -m -u $uid -g $gid -o -s /bin/bash tmanager

USER $user
