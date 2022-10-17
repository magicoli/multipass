#!/bin/bash

if [ ! "$1" ]
then
  echo "Usage:"
  echo "  $0 [remotehost:]/destination/path/to/plugin/" >&2
  exit 1
fi

PGM=$(basename $0)

for destination in $@
do
  echo $PGM: updading $destination >&2
  rsync --delete -Wavz ./ $destination/ --include=vendor/composer/ --exclude-from=.distignore --exclude-from=.gitignore
  result=$?
  if [ $result -ne 0 ]
  then
    echo "error $result while reploying to $destination"
    exit $result
  fi
  echo $PGM: $destination updated >&2
done
