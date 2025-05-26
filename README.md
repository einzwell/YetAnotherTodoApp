# Laravel 11 Todo Application

A full-stack todo list application, built with Laravel 11, Laravel Breeze, and PostgreSQL.

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

6. Install Laravel Breeze:
```bash
php artisan breeze:install blade
npm run build
```

7. Start the development server:
```bash
php artisan serve
```

## Requirements

- PHP 8.2+
- Laravel 11
- PostgreSQL 17
- Node.js & NPM
