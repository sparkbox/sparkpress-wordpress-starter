#!/bin/bash

export $(grep -v '^#' .env | xargs)

# copy the most recent .sql.gz file in the sync/sql folder for import
cp "$(ls -t sync/sql/*.sql.gz | head -1)" sync/sql/db-import-raw.sql.gz
if [ $? -ne 0 ]
then
  echo "There must be at least one .sql.gz file in the sync/sql folder to import"
  echo "Skipping database import"
  exit 0
fi

gunzip sync/sql/db-import-raw.sql.gz

# replace environment-specific URLs with localhost URL
sed "s/$SITE_URL/http:\/\/localhost:8000/g" sync/sql/db-import-raw.sql > sync/sql/db-import.sql

# drop existing database, create a new one, and load it up with data
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD -e "drop database if exists $MYSQL_DATABASE"
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD -e "create database $MYSQL_DATABASE"
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD $MYSQL_DATABASE < sync/sql/db-import.sql

# clean up files that aren't useful after import
rm sync/sql/db-import*

mkdir -p sync/sql/previous-imports
mv sync/sql/*.sql.gz sync/sql/previous-imports
