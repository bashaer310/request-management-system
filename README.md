# Request Management System

This is a web application for **an internal request management system**, built with Laravel and MySQL. The system enables organizations to efficiently create, track, and approve requests, including role-based approvals and real-time notifications. It includes core features like **user authentication**, **request management**, and **API access**.

## Live Demo

https://github.com/user-attachments/assets/0cd193aa-05da-4138-9147-b64177854563


## Features

- **User Management**:
  - **User Registration** - users can create an account
  - **Authentication & Authorization** - users can login with role-based access
  - **Profile Management** - users can view and update their profile
 
- **Request Management**:
  - **Request Creation** - Users can submit requests
  - **Request listing** - users can retrieve their own requests
  - **Request Details** - users can view request details
  - **Request Status Management** - Managers can approve or reject requests
  - **Notifications** - Users receive notifications upon request approval or rejection

- **API Access**
  - **Get API Endpoint** - Authorized users can fetch requests
 
## Technologies Used

- Languages
    - PHP - Server-side programming language
    - HTML - Page structure and markup
    - CSS - Styling and layout
    - JavaScript - Client-side interactivity

- Frameworks
    - Laravel - Web application framework
    - Bootstrap - CSS framework

- Database
    - MySQL - Relational database 

- Packages
    - Laravel Eloquent ORM - Database interaction and ORM
    - Laravel Authentication (breeze & Sanctum) - User authentication 

- Package manager
    - Composer - Dependency and package manager for PHP
  
- Tools
    - XAMPP - Local development environment 
    - Laravel Artisan - Command-line tool for Laravel
 
## Getting Started

1. Clone the repository:
```bash
   git clone https://github.com/bashaer310/request-management-system
```

2. Navigate to the project folder:
```bash
   cd request-management-system
```

3. Install dependencies:

Make sure Composer and and Node.js are installed, then run:
```bash
   composer install
   npm install
   npm run build
```
4. Configure Environment

- Copy the environment file:
```bash
   cp .env.example .env
```

- Open the .env file and update the database configuration:
```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
```
Ensure your database server (MySQL) is running and the database exists.

5. Generate application key
```bash
   php artisan key:generate
```

6. Run migrations
```bash
   php artisan migrate --seed
```

7. Run the application
```bash
   php artisan serve
```

8. Test the application and api
- The application will be available at: http://localhost:8000
- The api will be available at: http://localhost:8000/api

## Project structure

```bash
Request-Management-System/
├── app/
│   ├── Http/             # Controllers
│   ├── Models/           # Eloquent models representing database tables
│   ├── Policies/         # Authorization rules
├── resources/            # Blade views, CSS, JS
├── routes/               # Web and API routes
├── database/             # Migrations, Seeders
├── config/               # Application configuration
├── .env                  # Environment variables
├── artisan               # CLI commands
└── composer.json         # Dependencies
```

## License
This project is licensed under the MIT License.
