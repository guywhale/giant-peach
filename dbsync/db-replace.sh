#!/bin/bash

# Config file
SOURCE="${BASH_SOURCE[0]}"
while [ -h "$SOURCE" ]; do
	DIR="$( cd -P "$( dirname "$SOURCE" )" && pwd )"
	SOURCE="$( readlink "$SOURCE" )"
	[[ $SOURCE != /* ]] && SOURCE="$DIR/$SOURCE"
done

DIR="$( cd -P "$( dirname "$SOURCE" )" && cd .. && pwd )"

CONFIG=${DIR}
# CONFIG=${DIR%/*/*/*}

# Import config settings
source "$CONFIG/.env"

# Local config
LOCAL_DATABASE_HOST=$DB_HOST
LOCAL_URL=$URL_LOCAL
LOCAL_PORT=$DB_PORT
LOCAL_DATABASE_NAME=$DB_DATABASE
LOCAL_DATABASE_USER=$DB_USERNAME
LOCAL_DATABASE_PASS=$DB_PASSWORD

DOMAIN_REMOTE=$URL_REMOTE


# Current timestamp
CURRENT_TIME=$(date "+%Y.%m.%d-%H.%M.%S")

# Create directory to store dumps
mkdir -p "$CONFIG"/dumps

# Check for database connections
if mysql -h $LOCAL_DATABASE_HOST --port=$LOCAL_PORT -u $LOCAL_DATABASE_USER -p$LOCAL_DATABASE_PASS -e 'use '"$LOCAL_DATABASE_NAME"; then

	echo Backing up local database \'$LOCAL_DATABASE_NAME\': $LOCAL_DATABASE_HOST
	# mysqldump -v -h $LOCAL_DATABASE_HOST --port=$LOCAL_PORT -u $LOCAL_DATABASE_USER -p$LOCAL_DATABASE_PASS $LOCAL_DATABASE_NAME > "$CONFIG"/dumps/local-database-$CURRENT_TIME.sql

	if [ -f vendor/interconnectit/search-replace-db/srdb.cli.php ]; then

		echo Running search and replace: $LOCAL_DATABASE_NAME

		# Run find/replace script
		php vendor/interconnectit/search-replace-db/srdb.cli.php -h $LOCAL_DATABASE_HOST --port=$LOCAL_PORT -n $LOCAL_DATABASE_NAME -u $LOCAL_DATABASE_USER -p $LOCAL_DATABASE_PASS -w wp_usermeta -s "$DOMAIN_REMOTE" -r "$DOMAIN_LOCAL"
		echo Search and replace complete: $LOCAL_DATABASE_NAME
	else
		echo ERROR: Script not found: vendor/interconnectit/search-replace-db/srdb.cli.php
	fi

else
	echo ERROR: Could not connect to the database: $LOCAL_DATABASE_NAME
fi
