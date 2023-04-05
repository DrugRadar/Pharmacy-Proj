

<p align="center" >
  <img style = "width:150px; height:110px;" src="https://user-images.githubusercontent.com/95037451/229926516-c8d728f1-e0b9-46f2-9a38-4fc5134cb39c.gif" />
  <h1 align="center"> <span style=" color : #fab52e; ">D</span>rug<span style = " color : #46cec0; ">R</span>adar</h1>
</p>


# Introduction

DrugRadar is a Laravel-based pharmacy system that simplifies the process of ordering and delivering medication. It provides a comprehensive solution for pharmacists, doctors, and clients to manage their orders and prescriptions from a single platform. Clients can easily place orders through a user-friendly interface, while pharmacists can add new medicines and doctors can optimize the flow of orders to ensure the best possible outcome for clients. The system's dashboard allows users to track order progress and status, and advanced features like DataTables ensure seamless operations for both clients and administrators.

DrugRadar is a highly versatile and customizable system that can be tailored to the unique needs of healthcare providers. It is a secure and reliable solution that streamlines medication management, enhances the customer experience, and improves the quality of patient care.
## Features

- Authentication.
- Permissions and Roles.
- Export all order details in Excel sheet.
- Automated email notifications for account verification, greeting, order confirmation, and inactive account reminders.
- Auto-assignment of orders to the nearest available pharmacy. 
- Streamlining the order process for improved efficiency and faster delivery times.
- Display total revenue for pharmacies and admins, with pharmacy-specific revenue for pharmacists and total revenue for admins. 
- Utilizing DataTables for optimized viewing and management of data.
- User Profiles with Role-based Access Control.
- Stripe package for secure and seamless payment.
- Admin can ban and unban doctors for a period of three days.
- Chart statistics.
- Dark Mode.


## Installation
 
```
1-  Clone the repository 
2-  composer install
3-  npm install
4-  cp .env-example .env
5-  php artisan key:generate
6-  php artisan migrate
7-  php artisan db:seed
8-  php artisan storage:link
9-  php artisan serve
10- php artisan schedule:work 
```

### To create an admin
```
php artisan create:admin --email=name@example.com --password=123456
```
## Technologies
- Laravel
- JS
- CSS
- MySQL
- HTML
- JQuery




## Demo

[Preview](https://www.youtube.com/watch?v=q13ReHRv8VM) :tv:


## Documentation

```
1- php artisan scribe:generate
```
```
2- Visit at: localhost:8000/docs
```

## Support

If you our work, feel free to:

⭐ this repository. It helps.


## Authors

- [Nada saeed](https://github.com/Nada98Sakr)

- [Hager Khaled](https://github.com/hagerk720)

- [Mariam Khaled](https://github.com/Marim99)

- [Radwa Nabil](https://github.com/radwanabil)

- [Radwa Khalil](https://github.com/radwakhalil22)



<div align="center">
  <a href="https://laravel.com/"><img src="https://img.shields.io/badge/Laravel-10.x-red.svg" alt="Laravel"></a>
  <a href="https://www.postman.com/"><img src="https://img.shields.io/badge/Postman-API%20Development-orange" alt="Postman"></a>
  <a href="https://www.mysql.com/"><img src="https://img.shields.io/badge/MySQL-8.x-blue.svg" alt="MySQL"></a>
  <a href="https://www.w3.org/Style/CSS/Overview.en.html"><img src="https://img.shields.io/badge/CSS-3-green.svg" alt="CSS"></a>
  <a href="https://www.javascript.com/"><img src="https://img.shields.io/badge/JavaScript-ES6-yellow.svg" alt="JavaScript"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</div>
