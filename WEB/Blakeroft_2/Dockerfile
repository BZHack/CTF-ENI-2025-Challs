FROM debian:12

COPY ./src/ /var/www/html/
WORKDIR /var/www/html

RUN apt update && apt install apache2 php-common libapache2-mod-php php-cli openssl curl zip -y

RUN mv 000-default.conf /etc/apache2/sites-available/000-default.conf && mv apache2.conf /etc/apache2/apache2.conf
RUN a2dismod --force autoindex

WORKDIR /var/www/html/Blakeroft_2

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer require firebase/php-jwt

RUN openssl genpkey -algorithm RSA -out private.pem -pkeyopt rsa_keygen_bits:2048
RUN openssl rsa -pubout -in private.pem -out public.pem

RUN chown www-data /var/www/html/Blakeroft_2 && chmod -R 775 /var/www/html/Blakeroft_2

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]
