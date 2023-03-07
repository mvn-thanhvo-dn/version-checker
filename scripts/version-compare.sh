#!/bin/bash
is_latest=false

compare_versions() {
  local v1=(${1//./ })  # Convert version 1 to an array of integers
  local v2=(${2//./ })  # Convert version 2 to an array of integers

  # Compare the corresponding array elements
  for ((i=0; i<${#v1[@]} && i<${#v2[@]}; i++)); do
    if ((10#${v1[i]} > 10#${v2[i]})); then
        return 1  # Version 1 is greater
    elif ((10#${v1[i]} < 10#${v2[i]})); then
        return 2  # Version 2 is greater
    fi
  done

  # If we get here, the common elements are equal
  if (( ${#v1[@]} > ${#v2[@]} )); then
    return 1  # Version 1 is longer
  elif (( ${#v1[@]} < ${#v2[@]} )); then
    return 2  # Version 2 is longer
  else
    return 0  # The versions are equal
  fi
}
