#!/usr/bin/env bash

#UPDATE APT REPO
apt-get update
apt-get dist-upgrade

#INSTALL SERVICES
apt-get install -y apache2 php5 php-pear php5-curl php5-mysql php-apc curl libssl0.9.8

#INSTALL DOCKER
if [[ ! -f "/usr/bin/docker" ]]; then
   curl -s https://get.docker.io/ubuntu/ | sh
fi

#LINK VAGRANT WWW TO APACHE WWW
if [ ! -d "/var/www/numir" ]; then
    ln -s /vagrant/project/web /var/www/numir
fi

#CREATE VIRTUAL HOST
if [ ! -f "/etc/apache2/sites-enabled/numir" ]; then
    cp /vagrant/VirtualHost /etc/apache2/sites-available/numir
    a2ensite numir
fi

#ENABLE APACHE MOD REWRITE
if [ ! -f "/etc/apache2/mods-enabled/rewrite" ]; then
    a2enmod rewrite
fi

#RESTART APACHE
service apache2 restart

#START SELENIUM DOCKER CONTAINER
if ! sudo docker ps | grep -q "lzhang/selenium"; then
    sudo docker run --net="host" -d lzhang/selenium
fi