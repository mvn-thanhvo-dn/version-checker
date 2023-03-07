for package in $(jq -r '.dependencies | keys | .[]' package.json); do
  latest_version=$(npm view $package version)
  installed_version=$(jq -r ".dependencies.$package" package.json | cut -c 2-)
  if [[ $installed_version != $latest_version ]]; then
    echo "Error: $package is not in the latest version"
    exit 1
  fi
done
