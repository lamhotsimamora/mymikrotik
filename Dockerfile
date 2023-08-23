FROM alpine:3.13

WORKDIR /var/www/localhost/htdocs

ENV DOMAIN="http://localhost"

ENV HTDOCS=/var/www/localhost/htdocs

ADD .config/entrypoint.sh /entrypoint.sh

RUN apk update && apk add apache2 php8-apache2 php8-mysqli php8-session php8-ctype mariadb-client && \
    sed -i '/LoadModule rewrite_module/s/^#//g' /etc/apache2/httpd.conf && \
    sed -i 's#AllowOverride [Nn]one#AllowOverride All#' /etc/apache2/httpd.conf && \
    sed -i 's/index.html/index.php/g' /etc/apache2/httpd.conf && chmod +x /entrypoint.sh

ADD . ./

ADD .config/database.php application/config/database.php

ADD .config/.setting .setting

ENTRYPOINT ["/entrypoint.sh"]
