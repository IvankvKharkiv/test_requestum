# FROM php:7.1.0-fpm-alpine
# RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql


# FROM php:7-fpm-alpine
# RUN docker-php-ext-install mysqli


FROM php:8.1-fpm

COPY composer /usr/local/bin

RUN apt -yqq update
RUN apt -yqq install libxml2-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install xml
RUN apt-get install -y libxslt1-dev
RUN docker-php-ext-install xsl
RUN pecl install xdebug\
    && docker-php-ext-enable xdebug

RUN apt-get update
RUN apt install mc -y
RUN apt install iproute2 -y


RUN apt-get install -y p7zip \
    p7zip-full \
    unace \
    zip \
    unzip \
    xz-utils \
    sharutils \
    uudeview \
    mpack \
    arj \
    cabextract \
    file-roller \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get update
RUN apt install nano

WORKDIR /var/www/test_requestum.com


# Dockerfile
ARG DOCKER_BASE_IMAGE=ftp

# FROM $DOCKER_BASE_IMAGE
# ARG USER=cmdb-123839
# ARG UID=1000
# ARG GID=1000
# default password for user
# ARG PW=123839
# Option1: Using unencrypted password/ specifying password
# RUN useradd -m ${USER} --uid=${UID} && echo "${USER}:${PW}" | \
    #   chpasswd
# Option2: Using the same encrypted password as host
# COPY /etc/group /etc/group 
# COPY /etc/passwd /etc/passwd
# COPY /etc/shadow /etc/shadow
# Setup default user, when enter docker container
#
# WORKDIR /home/${USER}




# RUN cd ..
# RUN cd /var/www/test_requestum.com
# RUN composer install

# RUN apt-get update
# RUN docker-php-ext-install pdo pdo-mysql

# RUN apt-get update && apt-get install -y libmcrypt-dev \
#     && pecl install mcrypt-1.0.2 \
#     && docker-php-ext-enable mcrypt