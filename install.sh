#!/usr/bin/env bash
set -e

REPOSITORY_URL="twister22"

if [[ "$1" == "--build-image" ]]; then
  TAG="v1.0-$(date "+%Y%m%d-%H%M%S")"

  echo -e "\e[32mBuilding Quiz-Time image\e[39m"
  docker build . -t "${REPOSITORY_URL}/quiz-time:${TAG}"

  echo -e "\e[32mInstalling Helm Chart\e[39m"
  helm install quiz-time chart --set quiz_time.image.tag="${TAG}"
else
  echo -e "\e[32mInstalling Helm Chart\e[39m"
  helm install quiz-time chart
fi