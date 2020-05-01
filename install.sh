#!/usr/bin/env bash
set -e

if [[ "$1" == "--build-images" ]]; then
  TIMESTAMP=$(date "+%Y%m%d-%H%M%S")
  TAG="v1.0-${TIMESTAMP}"

  echo "Building Quiz-Time web-app image"
  docker build app -t "twister22/quiz-time.web-app:$TAG" >/dev/null

  echo "Building Quiz-Time init-db image"
  docker build database -t "twister22/quiz-time.init-db:$TAG" >/dev/null

  echo "Installing Helm Chart"
  helm install quiz-time helm-chart --set init_db.image.tag="$TAG",quiz_time.image.tag="$TAG"
else
  echo "Installing Helm Chart"
  helm install quiz-time helm-chart
fi


