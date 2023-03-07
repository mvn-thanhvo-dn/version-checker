#!/bin/bash
is_auto=true
for package in $(jq -r '.require | keys | .[]' composer.json); do
  installed_version=$(jq -r ".require[\"$package\"]" composer.json)

  if [[ "$installed_version" == *"^"* || "$installed_version" == *"~"* || "$installed_version" == *"*"* ]]; then
    echo -e "\e[31mWarning: $package will update automatic to the latest version\e[0m"
    is_auto=true
  fi
done

# if [is_auto = true]; then
#   exit 1
# fi
