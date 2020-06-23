# Lumen RestFul
Custom from Lumen

## Requirements
- PHP latest version
- MariaDB or MySQL latest version
- git
- composer

## How to install
- Clone this repository
- User terminal or command line
- Execute `cp .env.example .env
- Edit database connection
   
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=database_name
        DB_USERNAME=database_user
        DB_PASSWORD=database_password

- Execute `composer install`
- Execute `php artisan migrate`
- Execute `php artisan db:seed`
- Execute `php artisan jwt:secret`

## How to run project

    php -S 0.0.0.0:8080 -t public

## Added Folders and files

To reduce the number of line on `controller` in this project, bussines process is separated into `Readers` and `Handlers`.
- `Handlers` is used to accomodate business process related to `changing` data into database.
- `Readers` is used to accomodate business process related to `getting` data from database.
- On `Core` felder also added some files:

    - `Handler.php` is interface class as the parent class of `Handler` classes.
    - `Reader.php` is interface class as the parent class of `Reader` classes.
    - `HasPaginate.php` is trait class as Pagination Helper.
    - `PagedList.php` is helper class as custom response pagination from LengthAwarePaginator, this changed relate with return on the controller.
- `ApiController.php` is a custom of the existing `Controller`, with added several helper methods to handle the standard response.

      - app
        - Core
          - Handlers (directory)
          - Readers (directory)
          - Handler.php
          - HasPaginate.php
          - PagedList.php
          - Reader.php
        - Http
          - Controllers
            - ApiController.php
