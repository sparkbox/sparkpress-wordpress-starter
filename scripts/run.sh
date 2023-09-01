#!/bin/bash

# Runs php scripts in a docker container based on the web image build by docker-compose
# This allows running of PHP scripts without having PHP installed locally or dealing with version inconsistencies
# Supports a `CI=true` flag that can be used for CI
# When `CI=true`, php scripts will be run using the local version of PHP
# This is useful in CI environments where docker is not installed

# Are we running in CI?
if [ "$CI" == "true" ]; then
  # Run the command locally
  exec "$@"
else
  # Run the command inside the Docker container
  docker run --rm -v .:/tmp -w=/tmp sparkpress-wordpress-starter-web "$@"
fi
