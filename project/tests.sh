#!/usr/bin/env bash

#Clear the symfony cache
sudo rm -rf /vagrant/project/app/cache/*

#Run the headless selenium docker
if ! sudo docker ps | grep -q "lzhang/selenium"; then
    sudo docker run --net="host" -d lzhang/selenium
fi

#Run the behat tests
cd /vagrant/project
php bin/behat @NumirDataExtractionToolBundle