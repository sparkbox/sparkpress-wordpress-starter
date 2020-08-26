FROM php:7.3-apache-buster

# When changings, also change in .circleci/config.yml
ENV WP_VERSION=5.5

RUN apt-get update \
      && apt-get install -y libpng-dev libjpeg62-turbo-dev libzip-dev

RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd mysqli pdo_mysql zip

RUN docker-php-ext-configure zip --with-libzip

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
  && cp -avr /tmp/wordpress/* /var/www/html/. \
  && rm -rf /tmp/wordpress /tmp/wordpress-${WP_VERSION}.zip

# So we can update plugins
RUN chown -R www-data:www-data /var/www
RUN find /var/www/ -type d -exec chmod 0755 {} \;
RUN find /var/www/ -type f -exec chmod 644 {} \;
