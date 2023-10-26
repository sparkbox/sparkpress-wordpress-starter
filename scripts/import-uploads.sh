#!/bin/bash

export $(grep -v '^#' .env | xargs)

# copy the most recent .tar.gz file in the sync/uploads folder for import
cp "$(ls -t sync/uploads/*.tar.gz | head -1)" sync/uploads/uploads-import.tar.gz
if [ $? -ne 0 ]
then
  echo "There must be at least one .tar.gz file in the sync/uploads folder to import"
  echo "Skipping uploads import"
  exit 0
fi

rm -rf uploads/*
mkdir -p uploads
tar -zxvf sync/uploads/uploads-import.tar.gz -C uploads
rm sync/uploads/uploads-import.tar.gz

mkdir -p sync/uploads/previous-imports
mv sync/uploads/*.tar.gz sync/uploads/previous-imports
