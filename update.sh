#!/bin/bash

NOW=$(date +"%m-%d-%Y")

php index.php
git add --all
git commit -m "service update: $NOW"
git pull origin master
git push origin master