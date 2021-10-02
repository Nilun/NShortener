FROM php:8.0-apache
COPY . /var/www/html
RUN chmod -R 777 /var/www/html/ 
EXPOSE 80/tcp
RUN mv -f 000-default.conf /etc/apache2/sites-enabled/