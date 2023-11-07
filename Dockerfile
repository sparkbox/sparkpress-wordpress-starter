FROM php:8.1-apache-buster as dev

LABEL org.opencontainers.image.source=https://github.com/sparkbox/sparkpress-wordpress-starter

ENV WP_VERSION=6.4

RUN apt-get update \
      && apt-get install -y libpng-dev libjpeg62-turbo-dev libzip-dev

RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-install gd mysqli pdo_mysql zip

# These apache modules are required and not enabled by default in this image
RUN a2enmod rewrite headers xml2enc proxy proxy_fcgi

COPY ./composer.json /var/www/html/composer.json
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install

# Get WordPress Files
RUN cd /tmp \
  && apt-get update -y \
  && apt-get install wget -y \
  && apt-get install zip -y \
  && wget http://wordpress.org/wordpress-${WP_VERSION}.zip \
  && unzip wordpress-${WP_VERSION}.zip \
      && rm -rf /tmp/wordpress/wp-content/themes/* \
      && rm -rf /tmp/wordpress/wp-content/plugins/* \
  && cp -avr /tmp/wordpress/* /var/www/html/. \
  && rm -rf /tmp/wordpress /tmp/wordpress-${WP_VERSION}.zip

# So we can update plugins
RUN chown -R www-data:www-data /var/www
RUN find /var/www/ -type d -exec chmod 0755 {} \;
RUN find /var/www/ -type f -exec chmod 644 {} \;

# make the linters executable so we can run them from containers
RUN chmod +x vendor/bin/phpcs
RUN chmod +x vendor/bin/twigcs

FROM dev as prod

COPY theme /var/www/html/wp-content/themes/sparkpress-theme
COPY plugins /var/www/html/wp-content/plugins
COPY wp-configs/wp-config.php /var/www/html/wp-config.php
COPY wp-configs/php.ini /var/www/html/php.ini
COPY wp-configs/.htaccess /var/www/html/.htaccess
