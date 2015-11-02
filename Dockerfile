FROM alpine:edge

MAINTAINER Vishnu Nair <me@vishnudxb.me>

RUN apk --update add openssh py-pip php-pgsql php-pdo_pgsql php-phar php-json php-openssl php-mcrypt php-ctype php-zlib php-dom php-fpm php-common php-cgi php-cli curl git nginx && rm /var/cache/apk/*

RUN pip install awscli

ENV AWS_CONFIG_FILE /var/www/aws/config

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

COPY . /var/www

WORKDIR /var/www

RUN composer install

ADD ./files/default /etc/nginx/sites-enabled/default
ADD ./files/nginx.conf /etc/nginx/nginx.conf
ADD ./files/php-fpm.conf /etc/php/php-fpm.conf 
RUN chown -R nobody:nobody /var/www

EXPOSE 80

CMD php-fpm -y /etc/php/php-fpm.conf && nginx && tail -f /var/log/*.log
