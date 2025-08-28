# Laravel Product API

A Laravel-based RESTful API for managing products and users.

## Overview

This project provides endpoints to create, read, update, and delete products. It is designed to be a starting point for e-commerce applications, inventory systems, or any scenario where structured product management is needed. The API leverages the power of Laravel, Eloquent ORM, and MySQL, and uses PHP 8.

## Features

- **Product CRUD:** Create, read, update, and delete products.
- **Product Model:** Fields include `name`, `description`, `price`, `stock`, and `featured`.
- **Validation:** Ensures product data integrity.
- **API Resource Controllers:** Clean RESTful endpoints.
- **Task API:** Additional endpoints for task management.
- **Scribe Documentation:** Interactive API docs and example requests/responses.

## Technology Stack

- Laravel
- PHP 8
- MySQL
- Eloquent ORM
- Scribe (for API docs)
- Blade (for views)

## API Endpoints

### Products

- `GET /api/products` - List all products
- `POST /api/products` - Create new product
- `GET /api/products/{id}` - Get a specific product
- `PUT/PATCH /api/products/{id}` - Update a product
- `DELETE /api/products/{id}` - Delete a product

#### Example Requests

**List Products**
```bash
curl --request GET \
  --get "http://localhost:8000/api/products" \
  --header "Content-Type: application/json" \
  --header "Accept: application/json"
```

**Create Product**
```bash
curl --request POST \
  "http://localhost:8000/api/products" \
  --header "Content-Type: application/json" \
  --header "Accept: application/json" \
  --data '{
    "name": "New Product",
    "description": "This is a new product.",
    "price": "19.99",
    "stock": 100,
    "featured": false
}'
```

### Tasks

- `GET /api/tasks` - List all tasks
- `POST /api/tasks/{task}/complete` - Mark a task as complete
- `POST /api/tasks/{task}/incomplete` - Mark a task as incomplete

## Database Schema

**Products Table**
```php
$table->id();
$table->string('name');
$table->text('description')->nullable();
$table->decimal('price', 8, 2);
$table->integer('stock');
$table->boolean('featured')->default(false);
$table->timestamps();
```

## Getting Started

1. Clone the repository
2. Run `composer install`
3. Set up your `.env` file and database
4. Run migrations: `php artisan migrate`
5. Start server: `php artisan serve`
6. Access API at `http://localhost:8000/api/products`

## API Documentation

Interactive API docs are available via Scribe at `/scribe`.

## License

_No license specified. Please add your license information._

---
Built by [repoleved08](https://github.com/repoleved08)
