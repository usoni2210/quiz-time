FROM php:5.6-apache

RUN docker-php-ext-install mysqli
RUN apt-get update && \
    apt-get install mysql-server apt-utils -y

WORKDIR /var/www/html/

COPY ./ ./

CMD ["/var/www/html/entrypoint.sh"]