#!/bin/bash

export $(grep -v '^#' .env | xargs)

timestamp=$(date -u +%Y-%m-%dT%H-%M-%S_%Z)
path='sync/uploads/exports'
prefix='uploads-export'

if [ $BACKUP ]
then
  path='sync/uploads/backups'
  prefix='uploads-backup'
fi

dirname=$prefix-$timestamp
filename=../$prefix-$timestamp.tar.gz

if [ $1 ]
then
  dirname=$1-$timestamp
  filename=../$1-$timestamp.tar.gz
fi

mkdir -p $path/$dirname
cp -rv uploads/ $path/$dirname
cd $path/$dirname
tar -czf $filename .
cd ..
rm -rf $dirname
