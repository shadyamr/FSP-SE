# Fire Service Provider (ERP)

## Description
Fire Protection Service Provider is an enterprise resource planning web application made using Laravel following the MVC pattern (Model, View, and Controller).

## Requirements
PHP >=8.0.25 
Composer
Node.JS
Laravel

## Tested on 
PHP 8.1.6 Apache

## Installation
```
git clone https://github.com/shadyamr/FSP-SE.git
```
Or download the package from [GitHub](https://github.com/shadyamr/FSP-SE/archive/refs/heads/main.zip).


## Dependencies
* [Node.JS](https://nodejs.org/).
* [Composer](https://getcomposer.org/).

## How to Run It?
After the installation on your local or container, do the following steps:
```
- Make a copy of .env.example and re-name it to .env
- Edit the DB information to your MySQL information in the .env and save it
```

Run the following commands:
```
- composer install
- npm install && npm run build
- php artisan key:generate
- php artisan migrate
```

Start the application using the following command:
```
- php artisan serve
```

In case you want to enable registration, head to routes/web.php and change
```php
Auth::routes(['register' => false]);
```
to
```php
Auth::routes();
```
## Note
If you received an error of not founded route, do the following command:
```
- php artisan route:cache
```