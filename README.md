# Yet Another Todo App

**Yet Another Todo App** is a simple web application that allows users to create, read, update, and delete tasks 
(a.k.a. todos). Bui;t with Laravel and utilising PostgreSQL, It is designed to be a lightweight and easy-to-use tool 
for managing personal tasks and to-do lists.

This application is built as a final project for the course "Web-Based Programming" at Bina Nusantara University 
in 2025.

A demo of this application is available at [todo.einzwell.dev](https://todo.einzwell.dev).

## Features

- User authentication (registration, login, logout)
- User account management (username/password change & deletion)
- Complete CRUD operations for todo items

## Installation

1. Clone the repository
2. Install dependencies:
    ```bash
    composer install
    npm install
    ```
3. Configure environment:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4. Set up database in `.env`:
    ```
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=laravel_todo
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
5. Run migrations:
    ```bash
    php artisan migrate
    ```
6. Compile assets:
    ```bash
    npm run build
    ```
7. Start the development server:
    ```bash
    php artisan serve
    ```

## Authors

- Yoga Smara ([@einzwell](https://github.com/einzwell))
- Rafli ([@FLYY27](https://github.com/FLYY27))
