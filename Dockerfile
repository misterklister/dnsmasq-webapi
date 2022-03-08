FROM ubuntu:latest

RUN apt-get update && \
    apt-get install --no-install-recommends --assume-yes \
    ca-certificates \
    supervisor \
    dnsmasq \
    nginx \
    php7.4-common php7.4-fpm && \
    mkdir -p /var/log/supervisor && \
    rm -rf /var/lib/apt/lists/*


COPY /config/supervisord/supervisord.conf /etc/supervisor/supervisord.conf
COPY /config/supervisord/conf.d /etc/supervisor/conf.d
COPY /config/nginx /etc/nginx/

COPY /vol/webapi /var/www/html/

RUN echo "conf-dir=/etc/dnsmasq.d/,*.conf" >> /etc/dnsmasq.conf

EXPOSE 53 80

CMD ["/usr/bin/supervisord"]