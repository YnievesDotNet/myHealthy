Find a Pro
============

Find a Pro is a web application for online reservation of services for professionals freelances.

It is made under the **Laravel 5** framework for **PHP**.

This App have Client Apps for Android, iOS, and is under build version for Windows Phone and Blackberry OS.

## Live Demo

You can try the *back stage* working [live demo](http://findapro.ynieves.net/)

## Features

These are the current features so far:

  * User SignUp process (with email notification)
  * Professional registration
  * Professional Contacts registration
  * Professional Services registration
  * Professional Services Availability management (basic)
  * Service Reservation (with email notification)
  * Search engine (basic)

## Official Documentation

To be available soon.

-----
## How to install:

* [Step 1: Get the code](#step1)
* [Step 2: Use Composer to install dependencies](#step2)
* [Step 3: Create database](#step3)
* [Step 4: Install](#step4)
* [Step 5: Start Page](#step5)

<a name="step1"></a>
### Step 1: Get the code - Clone the repository

    $ git clone https://github.com/ynievesdotnet/findapro.git
    
If you want to stand on the latest version:

    $ cd findapro

    $ git checkout tags/v1.0

-----
<a name="step2"></a>
### Step 2: Use Composer to install dependencies

    composer install

-----
<a name="step3"></a>
### Step 3: Create database

If you finished first three steps, now you can create database on your database server(MySQL). You must create database
with utf-8 collation(uft8_general_ci), to install and application work perfectly.
After that, copy .env.example and rename it as .env and put connection and change default database connection name, only database connection, put name database, database username and password.

-----
<a name="step4"></a>
### Step 4: Configure

**Change** the storage path in **.env** file to a writeable location

    STORAGE_PATH=/var/www/storage

Migrate database schema

    php artisan migrate

Populate database:

    php artisan db:seed

Run the server:

    php artisan serve

Type on web browser:

    http://localhost:8000/

-----
<a name="step5"></a>
### Step 5: Start Page

You can now register as new user and login.

## Contributing

Thank you for considering contributing to Find a Pro.

Please see CONTRIBUTING doc for further details.
You are welcome to join the core development team and enhance the development process apart from just code :)

### License

Find a Pro is open-sourced software licensed under the [AGPL](http://www.gnu.org/licenses/agpl-3.0-standalone.html).

Based in [Timegrid](https://github.com/alariva/timegrid.git) Software for Bussines
