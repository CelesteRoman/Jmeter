FROM php:8.2-cli

# Instalar PostgreSQL + drivers PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql \
    && docker-php-ext-enable pgsql pdo_pgsql

WORKDIR /app
COPY . /app

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]
