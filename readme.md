## About Laravel Vue Js

Reference By:

-   [PlayList Youtube](https://www.youtube.com/playlist?list=PLB4AdipoHpxaHDLIaMdtro1eXnQtl_UvE).
-   [Channel](https://www.youtube.com/c/CodeInspire).

## Learning Laravel + VUE Js

Project Laravel + Vuejs Dalam Proses Pembelajaran

## Installing admin LTE Io

npm install admin-lte@v3.0.0-alpha.2 --save

## Logo and Material Design

1. https://www.flaticon.com/

## Installing Mterial Design Library

1. font-awesome
   npm install @fortawesome/fontawesome-free
2. moment.js
   npm install moment --save (customisasi tanggal)
3. vue-progress bar
4. swaet-alert2
   npm install sweetalert2 (untuk alert interactive)

## Navigasi Uses Vue-Router

npm insatll vue-router

## Form Material and Backend Validation

npm i axios vform

## Membuat API User dan Method standart CRUD

php artisan make:controller API/UserController --api
php artisan route:list --> untuk memerika route apa saja yang ada pada aplikasi

## Security Issue

1.Pengamanan API kita menggunakan laravel/passport untuk generate api key

1. Installation

-   composer require laravel/passport / composer require laravel/passport:7.5.1 (untuk versi laravel 5.8)
-   php artisan migrate / php artisan vendor:publish --tag=passport-migrations
-   insatllation passport --> php artisan passport:install
-   publish passport compnenets --> php artisan vendor:publish --tag=passport-components

## Image Handling Library

1. Intervention Image

-   installation -> php composer.phar require intervention/image
-   publish servis ke laravel :
    php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravel5"
