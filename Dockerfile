FROM ubuntu:14.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update
RUN apt-get install -y apache2 libapache2-mod-php5 supervisor php5-sqlite

RUN rm -rf /var/www/html
ADD app /var/www/html
RUN chown -R www-data:www-data /var/www/html

RUN rm /etc/apache2/sites-enabled/000-default.conf
ADD deployment/apache_site.conf /etc/apache2/sites-enabled/web_ctf.conf
ADD deployment/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord"]
