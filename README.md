<!--<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>-->

# SRC

Système de Reporting basé sur les 
fichiers CSV, c’est-à-dire un système qui utilise les fichiers CSV comme source de données et 
qui permet de les analyser et de les visualiser de manière efficace et pertinente.


## Auteurs

- [@nevile27](https://www.github.com/nevile27)


## Démo

Cliquez sur les vignettes pour voir la video de démonstration sur youtube.

[![Demo](https://i9.ytimg.com/vi_webp/m-AIKhQjP_M/mq1.webp?sqp=CPyF860G-oaymwEmCMACELQB8quKqQMa8AEB-AH-CYAC0AWKAgwIABABGGUgZShlMA8=&rs=AOn4CLAr0k4a1oNVYNQc6O3pFws5lYansA)](https://youtu.be/m-AIKhQjP_M)

[![Demo](https://i9.ytimg.com/vi_webp/m-AIKhQjP_M/mq2.webp?sqp=CPyF860G-oaymwEmCMACELQB8quKqQMa8AEB-AH-CYAC0AWKAgwIABABGGUgZShlMA8=&rs=AOn4CLCevPSt3VLxUB4-aUpm5r-GifB80g)](https://youtu.be/m-AIKhQjP_M)

[![Demo](https://i9.ytimg.com/vi_webp/m-AIKhQjP_M/mq3.webp?sqp=CPyF860G-oaymwEmCMACELQB8quKqQMa8AEB-AH-CYAC0AWKAgwIABABGE0gZShiMA8=&rs=AOn4CLD7l9RHVf7WfjAQDPL6dXAFC8Vi_g)](https://youtu.be/m-AIKhQjP_M)


## Installation en local

4 outils sont nécessaire à l'installation local de l’application, à savoir :

    ▪ Un SGBD compatible avec Laravel 8;

    ▪ Les binaires PHP de version >= 7.3 ;

    ▪ Le gestionnaire de dépendance PHP Composer ;

    ▪ Le gestionnaire de dépendance JavaScript NPM.

Cloner le projet sur votre machine et exécuter les commandes suivantes :

```bash
  git clone https://github.com/nevile27/SRC
  cd SRC
  composer install
  npm install
  cp .env.example .env
  php artisan key:generate
  nano .env
```
Configurer les variables DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, et DB_PASSWORD du fichier .env avec les informations de connexion à la base de données créée pour le projet avec votre SGBD. Définir la variable SESSION_DRIVER sur `database` au lieu de `file` et la variable APP_URL sur `http://localhost:8000`.

Sauvegarder les modifications et exécuter les commandes :

```bash
  php artisan migrate
  php artisan serve
```
Vous pouvez alors accéder à l'application depuis votre navigateur avec l'url `http://localhost:8000`.



