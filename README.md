<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Table of Contents

1. [Project Setup Instructions](#project-setup-instructions)
2. [How to Run the Application](#how-to-run-the-application)
3. [How to use the UI](#how-to-use-the-UI)

---

# Project Setup Instructions

This guide will help you set up and configure the Laravel Task Management Application on your local machine.

---

## Prerequisites

Before you begin, ensure you have the following installed:

- **PHP** 
- **Composer**: PHP dependency manager
- **MySQL**: Or another supported database
- **Node.js & npm**: For managing frontend dependencies
- **Git**: For cloning the repository

---

## Step 1: Clone the Repository

Open your terminal, navigate to your projects directory, and run:

```bash
git clone https://github.com/ziyang1107/user-task-management.git
cd user-task-management
````

## Step 2: Install Composer Dependencies
```
composer install
```

## Step 3: Install Node Dependencies
```
npm install
```

## Step 4: Set Up Environment Variables
Copy the .env.example file to create a new .env file:
```
cp .env.example .env
```

Then open the .env file and configure the following settings:
Set the database details to match your local database setup:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name    # Replace with your database name
DB_USERNAME=your_database_user     # Replace with your database username
DB_PASSWORD=your_database_password # Replace with your database password
```

To use file-based storage for sessions and cache, set the following values in .env:
```
SESSION_DRIVER=file
```
```
CACHE_DRIVER=file
```



## Step 5: Generate Application Key
Generate an application key to secure user sessions and encrypted data:
```
php artisan key:generate
```

## Step 6: Set Up the Database
Option A: Automatic Database Setup

The application includes a custom command to automatically create and set up the database:
```
php artisan setup:database
```

This command will create the database (if it doesn’t exist) and run all migrations.



Option B: Manual Database Setup

If you prefer, you can set up the database manually with the following steps:

1) Create the Database: Log in to MySQL and create a new database:
```
CREATE DATABASE your_database_name;
```
2) Run Migrations: Execute migrations to create the necessary tables:
```
php artisan migrate
```
3) Seed the Database (Optional): Populate the database with sample data by               running:
```
php artisan db:seed
```
---
# How to Run the Application
Once you’ve completed the setup steps, follow these instructions to start and access the application.

## Step 1: Start the Laravel Development Server
Run the following command to start the Laravel development server:
```
php artisan serve
```

## Step 2: Access the Application
```
http://127.0.0.1:8000
```
___

# How to use the UI
The application provides a user-friendly interface for managing users and tasks.

1. User Management

	•	Viewing Users: Navigate to the User List section to view a list of registered users.
	•	Editing a User: Click Edit next under the actions, update the information, and save changes.
	•	Deleting a User: Click Delete under the actions, and confirm to remove them from the system.

2. Task Management

	•	Viewing Tasks: Go to the Task List section to see a list of tasks with details like title, description, due date, and assigned user.
	•	Adding a New Task: Click Add New Task, fill in details like title, description, status, due date, and assigned user, then save.
    •	Updating Task Status: Modify the task details.
	•	Editing a Task: Click Edit under actions, update the details, and save changes.
	•	Deleting a Task: Click Delete next to the task and confirm to remove it.
	













