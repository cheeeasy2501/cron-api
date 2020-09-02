FROM php:7.3-fpm


RUN apt-get update \
&& apt-get install -y \
           cron && docker-php-ext-install pdo pdo_mysql

ADD /docker/php-fpm/php.ini /usr/local/etc/php/conf.d/php.ini

#RUN touch /var/www/html/storage/logs/cron.log
COPY docker/cron/entrypoint.sh /opt/bin/entrypoint.sh
RUN chmod +x /opt/bin/entrypoint.sh

CMD ["/opt/bin/entrypoint.sh"]
