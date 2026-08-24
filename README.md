# PHP Login & Registration System

A simple authentication system built with PHP, MySQL, HTML and CSS.

This project was created as a learning project to understand how user
authentication works in PHP without using a framework.

## Technologies

- PHP
- MySQL
- PDO
- HTML5
- CSS3
- Apache
- XAMPP
- Git
- GitHub

## Development Environment

This project was developed locally using XAMPP Control Panel.

XAMPP was used to provide:

- Apache web server
- MySQL database server
- PHP runtime
- phpMyAdmin for database management

The project is located inside the XAMPP `htdocs` directory:

C:\xampp\htdocs\php-login-system

The application can be accessed locally at:

http://localhost/php-login-system/

## Features

- User registration
- User login
- User logout
- Password hashing
- Password verification
- Session-based authentication
- Input validation
- Email validation
- Duplicate username detection
- Duplicate email detection
- Prepared SQL statements
- PDO database connection

## Project Structure

```text
php-login-system/
│
├── index.php
├── README.md
├── .gitignore
│
├── css/
│   └── style.css
│
└── includes/
    ├── config_session.inc.php
    ├── dbh.inc.php
    │
    ├── signup.inc.php
    ├── signup_model.inc.php
    ├── signup_contr.inc.php
    ├── signup_view.inc.php
    │
    ├── login.inc.php
    ├── login_model.inc.php
    ├── login_contr.inc.php
    ├── login_view.inc.php
    │
    └── logout.inc.php