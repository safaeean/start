FROM nginx:latest

RUN apt-get update -y
RUN apt-get install -y wget zip unzip zsh git
RUN apt-get install -y nano
RUN apt-get install -y libzip-dev libpq-dev
RUN rm -rf /var/lib/apt/lists/*

#CMD envsubst < site.conf.template > default.conf

WORKDIR /var/www/app

EXPOSE 80
