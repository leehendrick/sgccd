FROM php:8.1-fpm

# Atualizar o sistema e instalar dependências
RUN apt-get update && \
    apt-get install -y \
    git \
    zip \
    unzip \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código do projeto para o contêiner
COPY . .

# Instalar as dependências do Composer
RUN composer install

# Expor a porta 8000 (ou a porta que você configurar para o servidor PHP)
EXPOSE 8000

# Comando para iniciar o servidor PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
