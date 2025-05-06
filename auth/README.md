# Auth Service

A simple authentication microservice built with Laravel.

## Features

- User registration
- Login with token generation
- Logout
- User profile

## Setup

```bash
# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Start server
php artisan serve
```

## API Routes

- `POST /api/register` - Register a new user
- `POST /api/login` - Login and get token
- `POST /api/logout` - Logout (requires auth)
- `GET /api/profile` - Get user profile (requires auth)

## Docker

```bash
docker-compose up -d
```
