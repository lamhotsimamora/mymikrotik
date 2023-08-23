#!/bin/sh

# Exit on non defined variables and on non zero exit codes
#set -eu

if [ "$DOMAIN" ];then
sed -i "s+DOMAIN+$DOMAIN+" $HTDOCS/.setting
fi

# check database if empty
while ! mysql -h $DBHOST -u $DBUSER -p$DBPASS -sse "select count(*) from t_bandwith;" $DBNAME  &> /dev/null ;do
        cat $HTDOCS/db/db_mikrotik_2022.sql | mysql -h $DBHOST -u $DBUSER -p$DBPASS $DBNAME
        sleep 2;
done

httpd -D FOREGROUND
