#!/bin/sh
cd ../;
case $2 in
    myariadb)
        mariadb-dump --user=$4 --password=$5 --lock-tables $3 $1 > storage/app/public/sql/$1.sql
        ;;

    mysql)
        mysqldump --user=$4 --password=$5 $3 $1 > storage/app/public/sql/$1.sql
        ;;

    postgresql)
        pg_dump --username=$4 --password=$5 $3 $1 > storage/app/public/sql/$1.sql
        ;;

    sqlite)
        sqlite3 $3 $1 > $1.sql
        ;;

    sqlsrv)
        bcp $3 $1 out storage/app/public/sql/$1.sql
        ;;

    *)
        echo "no"
        ;;
esac