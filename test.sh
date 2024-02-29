#!/bin/bash

if [ "$1" == "java" ]; then
  docker compose run backend-java mvn test
elif [ "$1" == "php" ]; then
  docker compose run backend-php php bin/phpunit
else
  echo "Please specify 'java' or 'php'."
fi
