# Использую официальный образ PHP с поддержкой Apache
FROM php:8.1-apache

# Устанавливаю необходимые расширения
RUN docker-php-ext-install pdo pdo_mysql

# Устанавливаю рабочий каталог
WORKDIR /var/www/html

# Копирую файлы проекта в контейнер
COPY . .

# Устанавливаю зависимости
RUN composer install
