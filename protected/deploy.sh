#!/bin/bash

path_to_shared="../shared";

# SHARED
if [ ! -d "$path_to_shared"  ]
then
mkdir "$path_to_shared";
chmod a+w "$path_to_shared";
fi

# CONFIG
if [ -d "$path_to_shared/config"  ]
then
cp "$path_to_shared/config/development.php" "config/development.php";
cp "$path_to_shared/config/production.php" "config/production.php";
cp "$path_to_shared/config/console.php" "config/console.php";
cp "$path_to_shared/config/test.php" "config/test.php";
cp "$path_to_shared/config/bootstrap.php" "config/bootstrap.php";
cp "$path_to_shared/config/common.php" "config/common.php";
else
mkdir "$path_to_shared/config";
cp "config/default/development.php" "$path_to_shared/config/development.php";
cp "config/default/production.php" "$path_to_shared/config/production.php";
cp "config/default/console.php" "$path_to_shared/config/console.php";
cp "config/default/test.php" "$path_to_shared/config/test.php";
cp "config/default/bootstrap.php" "$path_to_shared/config/bootstrap.php";
cp "config/default/common.php" "$path_to_shared/config/common.php";
echo "Config dir doesn't exist. Importing config from the cloned repository.";
fi

# RUNTIME
if [ ! -d "$path_to_shared/runtime"  ]
then
mkdir "$path_to_shared/runtime";
chmod a+w "$path_to_shared/runtime";
fi

if [ ! -L "runtime"  ]
then
ln -s "$path_to_shared/runtime" "runtime";
fi

# ASSETS
if [ ! -d "$path_to_shared/assets"  ]
then
mkdir "$path_to_shared/assets";
chmod a+w "$path_to_shared/assets";
fi

rm -rf "$path_to_shared/assets/*";

if [ ! -L "../assets"  ]
then
ln -s "shared/assets" "../assets";
fi

touch "$path_to_shared/assets";

# CLEAR APC
php5 -r "apc_clear_cache();"
