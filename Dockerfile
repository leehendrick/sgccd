FROM php:8.1-fpm
LABEL authors="hendrick"
WORKDIR /var/www/html
ENTRYPOINT ["top", "-b"]

# Instale as dependências do PHP
RUN apt-get update &&   \
    apt-get install -y  \
    git                 \
    zip                 \
    unzip               \
    && docker-php-ext-install pdo pdo_mysql

# Instale o composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Copie o códido do projeto para o contâiner
COPY . .

# Instale as dependências do Composer
RUN composer install

# Exponha  a porta 8000
