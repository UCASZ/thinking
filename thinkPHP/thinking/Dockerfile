FROM ubuntu:18.04

RUN sed -i 's/archive.ubuntu.com/mirrors.aliyun.com/g' /etc/apt/sources.list
ENV TZ=Asia/Shanghai
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update -y \
    && apt-get install -y nginx \
    unixodbc-dev unixodbc\
    proxychains libxml2-dev pkg-config gcc wget libssl-dev \
    libsqlite3-dev libcurl4-openssl-dev openssl \
    strace libonig-dev vim autoconf curl zip unzip php-zip

WORKDIR /home
RUN wget https://mirrors.sohu.com/php/php-7.4.11.tar.gz && tar -zxvf php-7.4.11.tar.gz && cd php-7.4.11 \
    && ./configure --prefix=/usr/local/php7 --exec-prefix=/usr/local/php7 --with-mhash --with-openssl --with-mysql --with-mysqli --with-pdo-mysql --with-iconv --with-zlib --enable-zip --enable-inline-optimization --enable-xml --with-gd --enable-mbstring --enable-ftp --enable-gd-native-ttf --enable-pcntl --enable-sockets --with-xmlrpc --enable-session --with-curl --enable-fpm \
    && make -j 2 && make install

ENV PATH "$PATH:/usr/local/php7/bin"

RUN cd /home/php-7.4.11/ext/pdo_mysql && phpize && ./configure --with-php-config=/usr/local/php7/bin/php-config && make && make install \
    && cd /home/php-7.4.11/ext/pdo_odbc && phpize && ./configure --with-php-config=/usr/local/php7/bin/php-config --with-pdo-odbc=unixODBC,/usr/ && make && make install \
    && cd /home/php-7.4.11/ext/curl && phpize && ./configure --with-php-config=/usr/local/php7/bin/php-config && make && make install \
    && cd /home/php-7.4.11/ext/fileinfo && phpize && ./configure --with-php-config=/usr/local/php7/bin/php-config && make && make install \
    && cd /home/php-7.4.11/ext/mysqli && phpize && ./configure --with-php-config=/usr/local/php7/bin/php-config && make && make install

COPY ./www.conf /usr/local/php7/etc/php-fpm.d/www.conf
COPY ./php-fpm.conf /usr/local/php7/etc/php-fpm.conf
COPY ./php.ini /usr/local/php7/lib/php.ini
COPY ./start.sh /start.sh

RUN rm /var/www/html/*.html \
    && chmod a+x /start.sh \
    && chown -R www-data:www-data /var/www/html \
    && ln -s /var/www/html /html

RUN (curl -sS https://getcomposer.org/installer | php) \
    && mv composer.phar /usr/local/bin/composer \
    && composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/

RUN apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && rm /home/*.tar.gz

COPY ./default /etc/nginx/sites-available/default

EXPOSE 8000
CMD ["/start.sh"]
