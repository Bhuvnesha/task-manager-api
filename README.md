# Task Manager API

A RESTful Task Manager API built with Laravel 12, MySQL, and Laravel Sanctum.

This project demonstrates authentication, task management, authorization using policies, validation, pagination, filtering, and API best practices.

---

## Features

### Authentication
- User Registration
- User Login
- User Logout
- Token-based authentication using Laravel Sanctum

### Task Management
- Create Task
- Get All Tasks
- Get Single Task
- Update Task
- Delete Task

### Task Features
- Task Status
    - Pending
    - In Progress
    - Completed
- Due Date Support
- Search Tasks
- Filter Tasks by Status
- Pagination

### Authorization
- Task ownership authorization using Laravel Policies
- Users can only access their own tasks

### Validation
- Form Request Validation
- Proper API validation responses

---

## Tech Stack

- PHP 8+
- Laravel 12
- MySQL
- Laravel Sanctum
- Postman

---

## Project Structure

```txt
app/
├── Http/
│   ├── Controllers/
│   │   └── API/
│   │       ├── AuthController.php
│   │       └── TaskController.php
│   │
│   ├── Requests/
│   │       ├── RegisterRequest.php
│   │       ├── LoginRequest.php
│   │       ├── StoreTaskRequest.php
│   │       └── UpdateTaskRequest.php
│   │
│   └── Resources/
│           └── TaskResource.php
│
├── Models/
│   ├── User.php
│   └── Task.php
│
├── Policies/
│   └── TaskPolicy.php
│
database/
├── migrations/
├── seeders/
└── factories/

routes/
└── api.php
```

---

## Installation

Clone the repository:

```bash
git clone <your-repository-url>
```

Go into project directory:

```bash
cd task-manager-api
```

Install dependencies:

```bash
composer install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

## Database Configuration

Update `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager_api
DB_USERNAME=root
DB_PASSWORD=
```

---

## Install Sanctum

```bash
composer require laravel/sanctum
```

Publish Sanctum config:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## Run Migrations

```bash
php artisan migrate
```

---

## Seed Database

Run sample data:

```bash
php artisan db:seed
```

OR

Fresh migration + seed:

```bash
php artisan migrate:fresh --seed
```

---

## Run Application

Start local server:

```bash
php artisan serve
```

Application runs at:

```txt
http://127.0.0.1:8000
```

---

## Authentication

This project uses Laravel Sanctum.

Protected routes require:

```txt
Bearer Token Authentication
```

Example Header:

```http
Authorization: Bearer YOUR_TOKEN
```

---

## API Endpoints

### Authentication

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register user |
| POST | `/api/login` | Login user |
| POST | `/api/logout` | Logout user |

---

### Tasks

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | Get all tasks |
| POST | `/api/tasks` | Create task |
| GET | `/api/tasks/{id}` | Get single task |
| PUT | `/api/tasks/{id}` | Update task |
| DELETE | `/api/tasks/{id}` | Delete task |

---

## Request Examples

### Register

**POST** `/api/register`

Request Body:

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}
```

---

### Login

**POST** `/api/login`

Request Body:

```json
{
    "email": "john@example.com",
    "password": "password"
}
```

Response:

```json
{
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    },
    "token": "1|your_generated_token"
}
```

---

### Create Task

**POST** `/api/tasks`

Headers:

```http
Authorization: Bearer YOUR_TOKEN
```

Request Body:

```json
{
    "title": "Finish Laravel API",
    "description": "Complete authentication module",
    "status": "pending",
    "due_date": "2026-06-15"
}
```

---

### Update Task

**PUT** `/api/tasks/1`

```json
{
    "title": "Updated Task",
    "description": "Updated description",
    "status": "completed",
    "due_date": "2026-06-20"
}
```

---

### Delete Task

**DELETE** `/api/tasks/1`

---

## Search and Filtering

### Search Task

```http
GET /api/tasks?search=laravel
```

### Filter by Status

```http
GET /api/tasks?status=completed
```

### Combined Search + Filter

```http
GET /api/tasks?search=api&status=pending
```

---

## Pagination

Default pagination:

```txt
10 records per page
```

Example:

```http
GET /api/tasks?page=2
```

---

## Authorization with Policies

The application uses Laravel Policies for task ownership.

Users can:
- View their own tasks
- Update their own tasks
- Delete their own tasks

Users cannot access tasks belonging to other users.

Policy:

```txt
app/Policies/TaskPolicy.php
```

---

## Validation

Validation handled using Laravel Form Requests.

Examples:

- RegisterRequest
- LoginRequest
- StoreTaskRequest
- UpdateTaskRequest

---

## Testing with Postman

Use:

```txt
Body → raw → JSON
```

Headers:

```http
Accept: application/json
Content-Type: application/json
Authorization: Bearer YOUR_TOKEN
```

---

## Seeder Data

Project supports database seeding for testing.

Example seeded data:
- Demo users
- Demo tasks
- Random task statuses
- Due dates

---

## Future Improvements

- Task Priority
- Role Based Access
- Notifications
- Swagger Documentation
- Unit Testing
- Docker Setup
- React Frontend

---

## Learning Concepts Covered

- REST APIs
- Authentication with Sanctum
- CRUD Operations
- Form Request Validation
- API Resources
- Policies & Authorization
- Eloquent Relationships
- Search & Filtering
- Pagination
- Database Seeding

---

## Author

Bhuvanesh A