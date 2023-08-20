#!/bin/sh
cd ../;
php artisan migrate:refresh;
exit ;