#!/bin/bash

export $(grep -v '^#' .env | xargs)

# copy the most recent .sql.gz file in the sql folder for import
cp "$(ls -t sql/*.sql.gz | head -1)" sql/db-import-raw.sql.gz
if [ $? -ne 0 ]
then
  echo "There must be at least one .sql.gz file in the sql folder to import"
  exit 1
fi

gunzip sql/db-import-raw.sql.gz

# replace environment-specific URLs with localhost URL
sed "s/$SITE_URL/http:\/\/localhost:8000/g" sql/db-import-raw.sql > sql/db-import.sql

# drop existing database, create a new one, and load it up with data
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD -e "drop database if exists $MYSQL_DATABASE"
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD -e "create database $MYSQL_DATABASE"
docker exec -i sparkpress_db mysql --user=$MYSQL_USER --password=$MYSQL_PASSWORD $MYSQL_DATABASE < sql/db-import.sql

# clean up files that aren't useful after import
rm sql/db-import*

mkdir -p sql/previous-imports
mv sql/*.sql.gz sql/previous-imports
