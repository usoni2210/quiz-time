#!/usr/bin/env bash

echo "Script Started"
retry=30
while [[ "$retry" -ge "0" ]]; do
  if mysql -h "$MYSQL_HOST_URL" -u "$MYSQL_USERNAME" -p"$MYSQL_PASSWORD" -e "show databases;"; then
    mysql -h "$MYSQL_HOST_URL" -u "$MYSQL_USERNAME" -p"$MYSQL_PASSWORD" "$DATABASE_NAME" <./database/database.sql
    mysql -h "$MYSQL_HOST_URL" -u "$MYSQL_USERNAME" -p"$MYSQL_PASSWORD" -e "use $DATABASE_NAME; show tables;"
    break;
  fi
   ((--retry))
  echo "Failed to connect to MySql, Remaining connection retry : $retry"
  sleep 5;
done

if [[ "$retry" -lt "0" ]]; then
  echo "job failed to connect to mysql"
  echo "mysql -h \"$MYSQL_HOST_URL\" -u \"$MYSQL_USERNAME\" -p\"$MYSQL_PASSWORD\""
  exit 1
fi
echo "Script Ended"

echo "Calling docker-php-entrypoint"
apache2ctl -D FOREGROUND