# Fire Service Provider (ERP)

## Description
Fire Protection Service Provider is an enterprise resource planning web application made using Laravel following the MVC pattern (Model, View, and Controller).

## Requirements
PHP >=7.1.20 
Composer
Node.JS
Laravel

## Tested on 
PHP 8.1.6 Apache

## Installation
```
git clone https://github.com/shadyamr/FSP-SE.git
```
Or download the package from [GitHub](https://github.com/shadyamr/FSP-SE).


## Dependencies
* [Node.JS](https://nodejs.org/).
* [Composer](https://getcomposer.org/).

## Command Line
After the installation on your local or container, run the following command:
```
- Rename .env.example to .env
- Edit the DB_ information in the .env and save it
- Run the following commands: composer install & php artisan key:generate & php artisan migrate
- Execute the next command to run the application: php artisan serve
```