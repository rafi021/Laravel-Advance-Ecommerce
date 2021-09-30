<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel-Advance-ECommerce
It is a Laravel 8 blade template based demo project reflecting advance features of a single vendor ecommerce platform. Build with love and open source for developers. 

1. Bootstrap 4.6
2. laravel/jetstream 
3. laravel/sanctum: ^2.11 
4. intervention/image: ^2.5
5. Sweet Alert 2.0
6. Notification Alert -Toastr
7. Datatables

## Getting Started Step by Step
1. In your root folder, clone the project file using git clone https://github.com/rafi021/Laravel-Advance-Ecommerce.git
2. Open terminal (bash/cmd). Then go to project folder using command

```sh
cd Laravel-Advance-Ecommerce
```

3. Then install required files and libraries using 

```sh
composer install
```

4. Then create a .env file and generate key for this project using command 

```sh
cp .env.example .env

php artisan key:generate
```

5. Then compile all CSS & JS files together using this command

```sh
npm install && npm run dev
```

or

```sh
yarn install && yarn run dev
```
6. Create a database in MYSQL and connect it with your project via updating .env file.
7. After connecting the db with project, then run command 

```sh
php artisan migrate:fresh --seed
```

After completing the migration and seeding of db, you will have 2 user ready for login in this project. 
A.  Admin -> Admin
    Email -> admin@gmail.com
    Pass -> 12345678

B.  User -> User
    Email -> user@gmail.com
    Pass -> 12345678

Finally we are ready to run our project using this command 

```sh
php artisan serve
```
