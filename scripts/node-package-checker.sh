#!/bin/bash

# Check source code have node package
if [ -f "package.json" ]; then
  # Install package
  npm ci

  echo "=========================Node package version check========================="
  source ./scripts/version-compare.sh

  # Check dependencies package is in latest version
  for package in $(jq -r '.dependencies | keys | .[]' package.json); do
    latest_version=$(npm view $package version)
    installed_version=$(jq -r ".dependencies[\"$package\"]" package.json | cut -c 2-)

    compare_versions "$installed_version" "$latest_version"
    result_compare=$?

    if [[ result_compare -eq 0 ]]; then
      echo -e "\e[31mWarning: $package is in the latest version\e[0m"
      is_latest=true
    fi
  done

  # Check dev dependencies package is in latest version
  for package in $(jq -r '.devDependencies | keys | .[]' package.json); do
    latest_version=$(npm view $package version)
    installed_version=$(jq -r ".devDependencies[\"$package\"]" package.json | cut -c 2-)

    compare_versions "$installed_version" "$latest_version"
    result_compare=$?

    if [[ result_compare -eq 0 ]]; then
      echo -e "\e[31mWarning: $package is in the latest version\e[0m"
      is_latest=true
    fi
  done
fi

if [ $is_latest = true ]; then
  exit 1
fi
