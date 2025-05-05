# Laravel Microservices Example

A practical example of implementing microservices architecture using Laravel, demonstrating service isolation, API communication, and containerized deployment.

## Architecture Overview

This project implements a simple microservices architecture with two independent services:

- **Auth Service**: Handles user authentication, registration, and profile management
- **Posts Service**: Manages post CRUD operations with token verification

Each service runs as a separate Laravel application with its own database, following true microservice principles of isolation and independence.

## Key Features

- 🔐 **Secure Authentication**: Token-based authentication using Laravel Sanctum
- 🔄 **Cross-Service Communication**: Services communicate via REST APIs
- 📦 **Containerized Deployment**: Docker configuration for easy deployment
- 🌐 **API Gateway**: Nginx as a unified entry point for clients
- 🛡️ **Independent Databases**: Each service maintains its own data store
- 🚀 **Scalable Architecture**: Services can be scaled independently

## Services

### Auth Service

The Auth Service is responsible for:

- User registration
- User login/logout
- Token generation
- User profile management

### Posts Service

The Posts Service is responsible for:

- Creating posts
- Retrieving posts (with user data)
- Updating posts
- Deleting posts
- Filtering posts by authenticated user

## Technical Implementation

### Token Verification

The Posts Service verifies tokens with the Auth Service using a custom middleware that makes API calls to validate the token and retrieve user data.

### Service Communication

Services communicate via HTTP REST APIs, maintaining loose coupling and independence:

```php
private function getUserData($token)
{
    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->get(config('services.auth_service.url') . '/api/profile');
        
        if ($response->successful()) {
            return $response->json();
        }
        
        return null;
    } catch (\Exception $e) {
        return null;
    }
}
```

### Docker Configuration

The project includes Docker Compose configuration for containerized deployment:

```yaml
version: '3'

services:
  auth-service:
    build:
      context: ./auth-service
    # ...configuration

  posts-service:
    build:
      context: ./posts-service
    # ...configuration

  # Database containers
  auth-db:
    # ...configuration
    
  posts-db:
    # ...configuration
    
  # API Gateway
  nginx:
    # ...configuration
```

## When to Use Microservices

This architecture is suitable when:

- Your application has clearly separable business domains
- Different components have different scaling needs
- You need independent deployment of features
- You have multiple teams working on different components
- Your domain is complex and better managed in smaller parts

## Getting Started

### Prerequisites

- Docker and Docker Compose
- Composer

### Installation

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/laravel-microservices-example.git
   cd laravel-microservices-example
   ```

2. Start the services:
   ```
   docker-compose up -d
   ```

3. The services will be available at:
   - Auth Service: http://localhost:8001
   - Posts Service: http://localhost:8002
   - phpmyadmin GUI: http://localhost:8085

## API Endpoints

### Auth Service

- `POST /auth/register` - Register a new user
- `POST /auth/login` - Login a user
- `POST /auth/logout` - Logout a user (requires authentication)
- `GET /auth/profile` - Get user profile (requires authentication)

### Posts Service

- `GET /posts` - Get all posts for authenticated user
- `POST /posts` - Create a new post (requires authentication)
- `GET /posts/{id}` - Get a specific post (requires authentication)
- `PUT /posts/{id}` - Update a post (requires authentication)
- `DELETE /posts/{id}` - Delete a post (requires authentication)

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).