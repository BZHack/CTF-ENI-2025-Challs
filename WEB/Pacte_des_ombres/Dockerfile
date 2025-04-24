FROM debian:12

COPY src/Pacte_des_ombres/ /var/www/html/
WORKDIR /var/www/html

RUN apt update && apt install apache2 php-common libapache2-mod-php php-cli cron -y

COPY src/000-default.conf /tmp/000-default.conf
COPY src/apache2.conf /etc/apache2/apache2.conf
RUN a2dismod --force autoindex
RUN echo "disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,pcntl_exec" > /etc/php/8.2/apache2/php.ini
RUN echo "allow_url_fopen = Off" > /etc/php/8.2/apache2/conf.d/99-custom.ini

RUN chown -R www-data:www-data /var/www/html/ && chmod -R 775 /var/www/html/

COPY src/cleanup.sh /root/cleanup.sh
RUN chmod +x /root/cleanup.sh
RUN echo "* * * * * root /root/cleanup.sh" >> /etc/crontab

RUN useradd -m secret_user
COPY src/flag.txt /home/secret_user/.Fl4g.txt
RUN chmod 774 /home/secret_user/.Fl4g.txt

EXPOSE 80
CMD service cron start && apache2ctl -D FOREGROUND
