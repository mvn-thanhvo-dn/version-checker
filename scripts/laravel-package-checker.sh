#!/bin/bash

echo "=========================Laravel package version check========================="
source ./scripts/version-compare.sh

for package in $(jq -r '.require | keys | .[]' composer.json); do
  latest_version=$(composer show $package --all | grep -m1 -oE '[0-9]+\.[0-9]+\.[0-9]+' | head -1)
  installed_version=$(jq -r ".require[\"$package\"]" composer.json | cut -c 2-)

  compare_versions "$installed_version" "$latest_version"
  result_compare=$?

  if [[ result_compare -eq 0 ]]; then
    echo -e "\e[31mWarning: $package is in the latest version\e[0m"
    is_latest=true
  fi
done

if [is_latest = true]; then
  exit 1
fi
