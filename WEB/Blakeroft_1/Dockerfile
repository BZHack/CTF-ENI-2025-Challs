FROM debian:12

COPY ./src/ /var/www/html/
WORKDIR /var/www/html/

RUN apt update && apt install apache2 -y
RUN mv 000-default.conf /etc/apache2/sites-available/000-default.conf && mv apache2.conf /etc/apache2/apache2.conf
RUN a2dismod --force autoindex
RUN chown www-data /var/www/html/Blakeroft_1 && chmod -R 775 /var/www/html/Blakeroft_1

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]
