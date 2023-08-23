#!/bin/sh

# Exit on non defined variables and on non zero exit codes
#set -eu

if [ "$DOMAIN" ];then
sed -i "s+DOMAIN+$DOMAIN+" $HTDOCS/.setting
fi

# check database if empty
mysql -h $DBHOST -u $DBUSER -p$DBPASS -sse "select count(*) from t_bandwith;" $DBNAME &> /dev/null
STATUS=$?
if [ ! $STATUS == "0" ];then
	cat $HTDOCS/db/db_mikrotik_2022.sql | mysql -h $DBHOST -u $DBUSER -p$DBPASS $DBNAME
fi

httpd -D FOREGROUND
