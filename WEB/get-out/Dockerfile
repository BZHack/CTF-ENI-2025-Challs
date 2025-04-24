FROM debian:12

COPY ./src/ /var/www/html
WORKDIR /var/www/html/

RUN apt update && apt install pip python3.11-venv -y

RUN chown www-data /var/www/html/website && chmod -R 775 /var/www/html/website

RUN python3 -m venv flask
RUN flask/bin/pip install flask Pillow

EXPOSE 5000
CMD ["flask/bin/python3", "app.py"]
