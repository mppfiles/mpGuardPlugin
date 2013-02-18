#!/bin/bash

set -e

echo "Building schema..."
php symfony propel:build-schema
cp plugins/mpGuardPlugin/config/schema.custom.yml config/schema.custom.yml

echo "Building model..."
php symfony propel:build --all-classes

echo "Fixing model classes..."
find lib/model -maxdepth 1 -name "sfGuard*" -not -name "*Query*" -exec sed -i "s/BasesfGuard/PluginsfGuard/g" '{}' \;
find lib/form -maxdepth 1 -name "sfGuard*" -not -name "*Query*" -exec sed -i "s/BasesfGuard/PluginsfGuard/g" '{}' \;
find lib/filter -maxdepth 1 -name "sfGuard*" -not -name "*Query*" -exec sed -i "s/BasesfGuard/PluginsfGuard/g" '{}' \;

echo "Done! :D"
