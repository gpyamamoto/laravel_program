FROM centos:7

# 各パッケージのアップデート
RUN yum -y update

# remi リポジトリの追加（remi を入れるには epel も必要）
RUN yum -y install epel-release
RUN rpm -Uvh http://rpms.famillecollet.com/enterprise/remi-release-7.rpm

# Apache(httpd), PHP のインストール
RUN yum -y --enablerepo=remi,remi-php73 install \
    httpd \
    php \
    php-cli \
    php-common \
    php-devel \
    php-gd \
    php-mbstring \
    php-mysqli \
    php-mysqlnd \
    php-mcrypt \
    php-fpm \
    php-zip \
    php-pdo \
    php-pecl-apcu \
    php-pecl-xdebug \
    php-pecl-zip \
    php-xml \
    php-xmlrpc

# ===============================================================================
# BASE packages
# ===============================================================================
RUN yum --enablerepo=extras clean metadata
RUN yum install -y zlib zlib-devel make gcc gcc-c++ openssl openssl-devel readline-devel pcre pcre-devel
RUN yum install -y openssh openssh-server
RUN yum install -y net-tools wget sudo
RUN yum install -y tar zip unzip bzip2 which tree
RUN yum install -y git

# composerのインストール
WORKDIR /tmp
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN useradd developer
RUN groupadd web
RUN gpasswd -a apache web
RUN gpasswd -a developer web
RUN chown -R apache:web /var/www
RUN chmod g+ws -R /var/www

# composerでlaravelのインストール
USER developer
RUN composer global require "laravel/installer"
RUN echo 'PATH=$PATH:$HOME/.composer/vendor/bin' >> ~/.bashrc
RUN source ~/.bash_profile

# プロジェクトの作成
WORKDIR /var/www
RUN composer create-project --prefer-dist laravel/laravel /var/www/html --prefer-dist

USER root
RUN chmod g+ws -R /var/www/html


# httpd.conf のログを stdout, stderr に繋ぐ
RUN ln -sf /dev/stdout /var/log/httpd/access_log && \
    ln -sf /dev/stderr /var/log/httpd/error_log

# mime タイプのファイル追加
RUN ln -sf /etc/mime.types /etc/httpd/conf/mime.types

# タイムゾーン設定
RUN ln -sf  /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

# PHP 設定ファイル
COPY php.ini /etc/php.ini

# データベースの設定
RUN sed -i -e 's/DB_HOST=127.0.0.1/DB_HOST=mysql/' \
-e 's/DB_DATABASE=homestead/DB_DATABASE=wow/' \
-e 's/DB_USERNAME=homestead/DB_USERNAME=root/' \
-e 's/DB_PASSWORD=secret/DB_PASSWORD=gpol1515/' \
/var/www/html/.env
RUN sed -i -e "s/env('DB_HOST', '127.0.0.1')/env('DB_HOST', 'mysql')/" \
-e "s/env('DB_DATABASE', 'forge')/env('DB_DATABASE', 'wow')/" \
-e "s/env('DB_USERNAME', 'forge')/env('DB_USERNAME', 'root')/" \
-e "s/env('DB_PASSWORD', '')/env('DB_PASSWORD', 'gpol1515')/" \
/var/www/html/config/database.php

# httpd をフォアグラウンドで動かす（コンテナ内で処理が終わらない）
CMD ["/usr/sbin/httpd","-D","FOREGROUND"]
