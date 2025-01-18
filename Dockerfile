# Usando a imagem PHP 8.1 com Alpine
FROM php:8.1-alpine

# Instalar dependências necessárias
RUN apk update && apk add --no-cache \
  openssl \
  bash \
  unzip \
  vim \
  git \
  $PHPIZE_DEPS \
  libzip-dev \
  zlib-dev \
  libsodium-dev \
  icu-dev

# Habilitar extensões PHP
RUN docker-php-ext-configure intl
RUN docker-php-ext-install zip sodium intl
RUN docker-php-ext-enable zip sodium

# Instalar o Composer (gerenciador de dependências PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho dentro do contêiner
WORKDIR /var/www

# Instalar as dependências
#RUN composer install --no-interaction --prefer-dist

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
