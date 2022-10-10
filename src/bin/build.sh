#!/bin/bash

phpcbf --standard=WordPress *.php admin/ includes/ public/ \
&& php7.4 /usr/local/bin/composer update --no-dev \
&& npm run build
