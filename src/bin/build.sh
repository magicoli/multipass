#!/bin/bash

PGM=$(basename $0)
trap 'previous_command=$this_command; this_command=$BASH_COMMAND' DEBUG
trap 'ret=$?; [ $ret -ne 0 ] && echo "$PGM: $previous_command failed (error $ret)" && exit $ret || echo "$PGM: success"' EXIT

phpcbf --standard=WordPress *.php admin/ includes/ public/ \
|| phpcbf --standard=WordPress *.php admin/ includes/ public/ \
&& php7.4 /usr/local/bin/composer update --no-dev \
&& npm run build
