#!/bin/bash

blocks_dir="./blocks"

if [ -d "$blocks_dir" ]; then
  directory_names=$(find "$blocks_dir" -mindepth 1 -maxdepth 1 -type d -exec basename {} \;)
  
  for dir_name in $directory_names; do
    echo "Running command for directory: $dir_name"
    wp-scripts build "blocks/$dir_name/src/index.js" --output-path="blocks/$dir_name/build/"
  done
else
  echo "Could not locate the 'blocks' folder."
fi
