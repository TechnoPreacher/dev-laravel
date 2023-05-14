## may be overwritten in .env with PHP_VERSION variable
ARG  PHP_VERSION




FROM php:${PHP_VERSION}

RUN a2enmod ssl rewrite

##for mstmp install (look at https://gist.github.com/michaelbragg/13cde0a3b6ae4770bbd578a8db2b7918#file-msmtprc)

## Basic tools and ssh2
RUN apt-get update -y &&\
    apt-get upgrade -y &&\
    apt-get install -y bash \
            curl \
            wget \
            ca-certificates \
            vim \
            msmtp\ 
            nano \
            git \
            default-mysql-client \
            && rm -rf /var/lib/apt/lists/*  

COPY msmtprc /etc/msmtprc                   
RUN chown :msmtp /etc/msmtprc && \          
    chmod 640 /etc/msmtprc                  

RUN echo "GREEN='\[\e[1;32m\]'" >> /root/.bashrc &&\
    echo "reset='\[\e[0m\]'" >> /root/.bashrc &&\
    echo 'PS1="${GREEN}(docker)${reset} [\u@\h \W]\\$ "' >> /root/.bashrc



## PHP
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        graphviz \
        libxrender1 libfontconfig \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install mysqli pdo_mysql pdo gd mbstring bcmath zip opcache

## XDEBUG    
RUN pecl install xdebug-3.1.6\
&& docker-php-ext-enable xdebug

## Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

## Node
ENV NODE_VERSION=16.13.0
RUN apt install -y curl
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
ENV NVM_DIR=/root/.nvm
RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version
RUN chown -R root:root .


RUN sed -e 's%www-data:x:33%www-data:x:1000%g' /etc/passwd -i

RUN chown -R www-data: .

WORKDIR /var/web/app
