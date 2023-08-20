#!/bin/sh
cd ../;
timeout 5 php artisan make:migration create_${1}s_table;
exit ;