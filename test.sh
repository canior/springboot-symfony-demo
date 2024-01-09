#!/bin/bash

if [ "$1" == "java" ]; then
  docker compose run backend-java mvn test
elif [ "$1" == "php" ]; then
  echo "Not implemented."
else
  echo "Please specify 'java' or 'php'."
fi