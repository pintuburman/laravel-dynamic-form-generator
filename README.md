<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Laravel Dynamic Form Generator
This is a simple laravel 8 Dynamic Form Generator app.

## How to install and run on your local system
1. git clone https://github.com/pintuburman/laravel-dynamic-form-generator.git
2. cd laravel-dynamic-form-generator/
3. In project path type terminal type **composer install**
4. In project path type terminal type **npm install**
5. In project path type terminal type **cp .env.example .env** (Note: In windows use this command **copy .env.example .env**)
6. In project path type terminal type **php artisan key:generate**
7. Add your **database config** in the **.env file**
8. In project path type terminal type **php artisan migrate** (Note: Make sure phpmyadmin **Apache and Mysql** is started and **database is created**)
9. In project path type terminal type **php artisan db:seed**
10. In project path type terminal type **php artisan serve** (if the server opens up, **http://127.0.0.1:8000,**  then we are good to go)

## Admin Login credentials
Url: http://127.0.0.1:8000/login

<p>Username: admin@admin.com<p>
<p>Password: password</p>

## Operations
## 1. Create Form

![plot](./public/step1.png)
![plot](./public/step2.png)

## 2. View a Form
![plot](./public/step5.png)

## 3. Edit a Form
![plot](./public/step4.png)
## 4. Delete a Form
![plot](./public/step3.png)
## 5. View all Forms
![plot](./public/step5.png)
