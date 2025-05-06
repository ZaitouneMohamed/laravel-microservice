# Posts Service

A simple posts management microservice built with Laravel.

## Features

- Create, read, update, delete posts
- Token verification with Auth Service
- User-specific post management

## Setup

```bash
# Install dependencies
composer install

# Environment setup
cp .env.example .env
php artisan key:generate

# Set Auth Service URL in .env
AUTH_SERVICE_URL=http://auth:8000

# Run migrations
php artisan migrate

# Start server
php artisan serve
```

## API Routes

- `GET /api/posts` - Get user's posts
- `POST /api/posts` - Create a new post
- `GET /api/posts/{id}` - Get a specific post
- `PUT /api/posts/{id}` - Update a post
- `DELETE /api/posts/{id}` - Delete a post

## Docker

```bash
docker-compose up -d
```
