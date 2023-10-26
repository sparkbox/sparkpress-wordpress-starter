#!/bin/bash

export $(grep -v '^#' .env | xargs)

timestamp=$(date -u +%Y-%m-%dT%H-%M-%S_%Z)
path='sync/sql/exports'
prefix='db-export'

if [ $BACKUP ]
then
  path='sync/sql/backups'
  prefix='db-backup'
fi

filename=$path/$prefix-$timestamp.sql

if [ $1 ]
then
  filename=$path/$1-$timestamp.sql
fi

# create folders if they don't already exist
mkdir -p $path

# generate SQL dump
docker exec -i sparkpress_db mysqldump --user=root --password=$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE > $path/$prefix-raw.sql

# replace localhost URLs with target environment URL
sed "s/http:\/\/localhost:8000/$SITE_URL/g" $path/$prefix-raw.sql > $filename

# gzip the DB export file
gzip $filename

# clean up file that's not useful after export
rm $path/$prefix-raw.sql
